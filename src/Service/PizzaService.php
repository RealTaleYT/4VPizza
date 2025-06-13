<?php

namespace App\Service;

use App\DTO\PizzaDTO;
use App\DTO\PizzaIngredientsDTO;
use App\Entity\Pizza;
use App\Repository\PizzaRepository;

class PizzaService
{
    private PizzaRepository $pizzaRepository;

    public function __construct(PizzaRepository $pizzaRepository)
    {
        $this->pizzaRepository = $pizzaRepository;
    }

    /**
     * Devuelve una lista de pizzas filtradas por nombre o ingredientes.
     */
    public function getPizzas(?string $name, ?string $ingredients): array
    {
        $pizzas = $this->pizzaRepository->findAllWithIngredients();
        $filtered = [];

        error_log("Total pizzas encontradas: " . count($pizzas));

        foreach ($pizzas as $pizza) {
            if (!$pizza instanceof Pizza) {
                continue;
            }

            error_log("Procesando pizza: " . $pizza->getTitle());

            if ($this->matchesFilters($pizza, $name, $ingredients)) {
                error_log("Pizza '" . $pizza->getTitle() . "' pasó el filtro");
                $filtered[] = $this->mapToDTO($pizza);
            } else {
                error_log("Pizza '" . $pizza->getTitle() . "' no pasó el filtro");
            }
        }

        error_log("Total pizzas filtradas: " . count($filtered));
        return $filtered;
    }

    private function matchesFilters(Pizza $pizza, ?string $name, ?string $ingredients): bool
    {
        // Filtrar por nombre (insensible a mayúsculas)
        $matchesName = !$name || stripos($pizza->getTitle(), $name) !== false;

        if (!$ingredients) {
            return $matchesName;
        }

        $ingredientList = array_map(fn($item) => strtolower(trim($item)), explode(',', $ingredients));

        $pizzaIngredientNames = array_map(
            fn($ingredient) => strtolower(trim($ingredient->getName())),
            $pizza->getIngredients()->toArray()
        );

        // Cambiamos strpos por comparación exacta en minúsculas
        foreach ($ingredientList as $searchTerm) {
            if (!in_array($searchTerm, $pizzaIngredientNames, true)) {
                // Ingrediente no encontrado exactamente
                error_log("No se encontró ingrediente buscado '{$searchTerm}'");
                return false;
            }
        }

        return $matchesName;
    }

    private function mapToDTO(Pizza $pizza): PizzaDTO
    {
        $dto = new PizzaDTO();
        $dto->setId($pizza->getId());
        $dto->setTitle($pizza->getTitle());
        $dto->setImage($pizza->getImage());
        $dto->setPrice($pizza->getPrice());
        $dto->ok_celiacs = $this->isCeliacSafe($pizza);
        $dto->setIngredients([]);

        foreach ($pizza->getIngredients() as $ingredient) {
            $ingredientDTO = new PizzaIngredientsDTO($ingredient->getName());
            $dto->addIngredient($ingredientDTO);
        }

        return $dto;
    }

    private function isCeliacSafe(Pizza $pizza): bool
    {
        foreach ($pizza->getIngredients() as $ingredient) {
            if (!$ingredient->isOkCeliacs()) {
                return false;
            }
        }
        return true;
    }
}

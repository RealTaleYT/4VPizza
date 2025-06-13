<?php
namespace App\DataFixtures;

use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;
use App\Entity\Pizza;
use App\Entity\PizzaIngredients;

class AppFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        // Ingredientes comunes
        $ingredientTomatoSauce = new PizzaIngredients();
        $ingredientTomatoSauce->setName('Tomato Sauce');
        $manager->persist($ingredientTomatoSauce);

        $ingredientCheese = new PizzaIngredients();
        $ingredientCheese->setName('Cheese');
        $manager->persist($ingredientCheese);

        $ingredientPepper = new PizzaIngredients();
        $ingredientPepper->setName('Pepper');
        $manager->persist($ingredientPepper);

        $ingredientOlives = new PizzaIngredients();
        $ingredientOlives->setName('Olives');
        $manager->persist($ingredientOlives);

        $ingredientMushrooms = new PizzaIngredients();
        $ingredientMushrooms->setName('Mushrooms');
        $manager->persist($ingredientMushrooms);

        // Pizza 1: Margarita (original)
        $pizza1 = new Pizza();
        $pizza1->setTitle('Margarita');
        $pizza1->setImage('https://imag.bonviveur.com/pizza-margarita.jpg');
        $pizza1->setPrice(12.35);
        $pizza1->addIngredient($ingredientTomatoSauce);
        $pizza1->addIngredient($ingredientCheese);
        $pizza1->addIngredient($ingredientPepper);
        $manager->persist($pizza1);

        // Pizza 2: Pepperoni (tiene queso y pimienta)
        $pizza2 = new Pizza();
        $pizza2->setTitle('Pepperoni');
        $pizza2->setImage('https://imag.bonviveur.com/pizza-pepperoni.jpg');
        $pizza2->setPrice(14.50);
        $pizza2->addIngredient($ingredientTomatoSauce);
        $pizza2->addIngredient($ingredientCheese);
        $pizza2->addIngredient($ingredientPepper);
        $manager->persist($pizza2);

        // Pizza 3: Cheese Only (solo queso)
        $pizza3 = new Pizza();
        $pizza3->setTitle('Cheese Delight');
        $pizza3->setImage('https://imag.bonviveur.com/pizza-cheese-delight.jpg');
        $pizza3->setPrice(11.00);
        $pizza3->addIngredient($ingredientCheese);
        $manager->persist($pizza3);

        // Pizza 4: Pepper Only (solo pimienta)
        $pizza4 = new Pizza();
        $pizza4->setTitle('Spicy Pepper');
        $pizza4->setImage('https://imag.bonviveur.com/pizza-spicy-pepper.jpg');
        $pizza4->setPrice(13.00);
        $pizza4->addIngredient($ingredientPepper);
        $manager->persist($pizza4);

        // Pizza 5: Veggie Special (aceitunas y champiñones)
        $pizza5 = new Pizza();
        $pizza5->setTitle('Veggie Special');
        $pizza5->setImage('https://imag.bonviveur.com/pizza-veggie-special.jpg');
        $pizza5->setPrice(13.75);
        $pizza5->addIngredient($ingredientTomatoSauce);
        $pizza5->addIngredient($ingredientOlives);
        $pizza5->addIngredient($ingredientMushrooms);
        $manager->persist($pizza5);

        // Pizza 6: Cheese and Olives
        $pizza6 = new Pizza();
        $pizza6->setTitle('Cheese & Olives');
        $pizza6->setImage('https://imag.bonviveur.com/pizza-cheese-olives.jpg');
        $pizza6->setPrice(12.75);
        $pizza6->addIngredient($ingredientCheese);
        $pizza6->addIngredient($ingredientOlives);
        $manager->persist($pizza6);

        // Pizza 7: Cheese and Mushrooms
        $pizza7 = new Pizza();
        $pizza7->setTitle('Cheese & Mushrooms');
        $pizza7->setImage('https://imag.bonviveur.com/pizza-cheese-mushrooms.jpg');
        $pizza7->setPrice(13.00);
        $pizza7->addIngredient($ingredientCheese);
        $pizza7->addIngredient($ingredientMushrooms);
        $manager->persist($pizza7);

        // Pizza 8: Pepper and Olives
        $pizza8 = new Pizza();
        $pizza8->setTitle('Pepper & Olives');
        $pizza8->setImage('https://imag.bonviveur.com/pizza-pepper-olives.jpg');
        $pizza8->setPrice(13.25);
        $pizza8->addIngredient($ingredientPepper);
        $pizza8->addIngredient($ingredientOlives);
        $manager->persist($pizza8);

        // Pizza 9: Pepper and Mushrooms
        $pizza9 = new Pizza();
        $pizza9->setTitle('Pepper & Mushrooms');
        $pizza9->setImage('https://imag.bonviveur.com/pizza-pepper-mushrooms.jpg');
        $pizza9->setPrice(13.25);
        $pizza9->addIngredient($ingredientPepper);
        $pizza9->addIngredient($ingredientMushrooms);
        $manager->persist($pizza9);

        // Pizza 10: Ultimate Mix (todos los ingredientes)
        $pizza10 = new Pizza();
        $pizza10->setTitle('Ultimate Mix');
        $pizza10->setImage('https://imag.bonviveur.com/pizza-ultimate-mix.jpg');
        $pizza10->setPrice(15.00);
        $pizza10->addIngredient($ingredientTomatoSauce);
        $pizza10->addIngredient($ingredientCheese);
        $pizza10->addIngredient($ingredientPepper);
        $pizza10->addIngredient($ingredientOlives);
        $pizza10->addIngredient($ingredientMushrooms);
        $manager->persist($pizza10);

        $manager->flush();
    }
}

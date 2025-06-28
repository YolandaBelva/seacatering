<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\MealPlan;

class MealPlanSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $mealPlans = [
            [
                'name' => 'Diet Plan',
                'price' => 30000,
                'description' => 'Light, nutrient rich meals to support your weight goals.',
                'features' => json_encode([
                    'Balanced meals for everyday health',
                    'Supports weight management and wellness',
                    'Includes a variety of fruits, vegetables, and whole grains'
                ]),
                'image_url' => 'diet.jpg',
                'long_description' => '
                <p>Looking to reach your weight goals without compromising on taste?</p>
                <p>Our Diet Plan is thoughtfully designed to support healthy weight management through satisfying, nutrient-rich meals.
                    Each dish is light on calories but rich in fiber and whole ingredients to keep you energized and in control without ever feeling deprived. Crafted by chefs and guided by nutritionists, the Diet Plan helps you stay on track with zero stress or guesswork.
                    Simple, clean, and delicious. Healthy eating made truly effortless.
                </p>
                <h3 class="mt-4 font-semibold text-gray-800">What You Get</h3>
                <ul class="list-disc list-inside text-sm text-gray-600">
                    <li>Carefully Portioned, Low-Calorie Meals</li>
                    <li>Vibrant Plant-Based & Lean Protein Options</li>
                    <li>Fresh, Whole Ingredients Only</li>
                    <li>New Menu Rotation Weekly</li>
                </ul>

                <h3 class="mt-4 font-semibold text-gray-800">Weekly Menu on Diet Plan</h3>
                <ul class="list-disc list-inside text-sm text-gray-600">
                    <li>Grilled Miso Tofu with Edamame, Sweet Corn & Cherry Tomatoes</li>
                    <li>Steamed Vegetable Stir-Fry with Soft-Boiled Egg and Sesame Dressing</li>
                    <li>Rainbow Bowl with Cabbage, Cherry Tomatoes, Cucumber, and Tofu Strips</li>
                </ul>

                <h3 class="mt-4 font-semibold text-gray-800">Average Nutritional Information</h3>
                <ul class="list-disc list-inside text-sm text-gray-600">
                    <li>Calories: 300 – 400 kcal per meal</li>
                    <li>Protein: ~18g-20g per meal</li>
                    <li>Carbohydrates: ~30–35g per meal</li>
                </ul>
                ',
            ],
            [
                'name' => 'Protein Plan',
                'price' => 40000,
                'description' => 'High protein meals to energize your day and build strength.',
                'features' => json_encode([
                    'Lean, High Protein Meals',
                    'Balanced Macros with Good Fats & Greens',
                    'Expert-Curated Weekly Recipes',
                    'Clean Ingredients, No Compromise'
                ]),
                'image_url' => 'protein.jpg',
                'long_description' => '
                <p>Need fuel to power your workouts and support muscle recovery?</p>
                <p>The High-Protein Plan is crafted for active individuals who demand more from every meal.
                   Each dish is built around clean, protein-rich ingredients to help you build lean muscle, stay energized, and feel full longer.
                   Our chefs design every recipe to maximize taste without compromising on nutrition.
                   Whether you’re hitting the gym, managing a high-energy lifestyle, or simply love clean eating, this plan is for you.</p>

                <h3 class="mt-4 font-semibold text-gray-800">What You Get</h3>
                <ul class="list-disc list-inside text-sm text-gray-600">
                    <li>Lean, High-Protein Meals</li>
                    <li>Balanced Macros with Good Fats & Greens</li>
                    <li>Expert-Curated Weekly Recipes</li>
                    <li>Clean Ingredients, No Compromise</li>
                </ul>

                <h3 class="mt-4 font-semibold text-gray-800">Weekly Menu on Protein Plan</h3>
                <ul class="list-disc list-inside text-sm text-gray-600">
                    <li>Grilled Teriyaki Chicken with Steamed Broccoli and Brown Rice</li>
                    <li>Baked Salmon with Avocado Salad and Lemon Dressing</li>
                    <li>Scrambled Egg Whites with Quinoa and Roasted Veggies</li>
                </ul>

                <h3 class="mt-4 font-semibold text-gray-800">Average Nutritional Information</h3>
                <ul class="list-disc list-inside text-sm text-gray-600">
                    <li>Calories: 400 – 550 kcal per meal</li>
                    <li>Protein: ~35g per meal</li>
                    <li>Carbohydrates: ~20–30g per meal</li>
                </ul>
                ',
            ],
            [
                'name' => 'Royal Plan',
                'price' => 60000,
                'description' => 'Gourmet experience in every bite, crafted for royalty.',
                'features' => json_encode([
                    'Premium meals with gourmet ingredients',
                    'Designed for those who appreciate fine dining',
                    'Includes exotic and seasonal ingredients'
                ]),
                'image_url' => 'royal.jpg',
                'long_description' => '
                <p>Want to elevate your healthy lifestyle with a touch of gourmet?</p>
                <p>Royal Plan brings premium nutrition and refined flavor together in one exclusive experience.
                   From hand-picked proteins to colorful superfoods, every meal is curated to nourish your body and delight your palate.
                   It’s wellness, without limits—delivered in every dish.
                   Perfect for busy professionals, health-conscious foodies, or anyone who wants the best of both worlds.</p>

                <h3 class="mt-4 font-semibold text-gray-800">What You Get</h3>
                <ul class="list-disc list-inside text-sm text-gray-600">
                    <li>Premium, Gourmet-Inspired Meals</li>
                    <li>Superfood Ingredients & Vibrant Colors</li>
                    <li>Curated by Chefs & Nutritionists</li>
                    <li>Luxury Taste with Clean Nutrition</li>
                </ul>

                <h3 class="mt-4 font-semibold text-gray-800">Weekly Menu on Royal Plan</h3>
                <ul class="list-disc list-inside text-sm text-gray-600">
                    <li>Grilled Miso Tofu with Edamame, Sweet Corn & Cherry Tomatoes</li>
                    <li>Roasted Herb Chicken with Quinoa and Zucchini Ribbons</li>
                    <li>Seared Tuna Bowl with Mango, Avocado & Mixed Greens</li>
                </ul>

                <h3 class="mt-4 font-semibold text-gray-800">Average Nutritional Information</h3>
                <ul class="list-disc list-inside text-sm text-gray-600">
                    <li>Calories: 500 – 600 kcal per meal</li>
                    <li>Protein: ~40g per meal</li>
                    <li>Carbohydrates: ~35–45g per meal</li>
                </ul>
                ',
            ],
        ];

        foreach ($mealPlans as $plan) {
            MealPlan::create($plan);
        }
    }
}
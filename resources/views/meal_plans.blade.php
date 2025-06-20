<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>SEA Catering - Meal Plans</title>
  <script src="https://cdn.tailwindcss.com"></script>
</head>
<body class="bg-white dark:bg-gray-900">
  <header class="bg-white shadow">
    @include('components.navbar'
      )
  </header>

  <section class="py-8 px-4 mx-auto max-w-screen-xl lg:py-16 lg:px-6">
    <div class="mx-auto max-w-screen-md text-center mb-8 lg:mb-12">
      <h2 class="mb-4 text-4xl tracking-tight font-extrabold text-gray-900 dark:text-white">
        Meal Plans for Every Lifestyle
      </h2>
      <p class="mb-5 font-light text-gray-500 sm:text-xl dark:text-gray-400">
        SEA Catering offers tailored meal plans to help you stay healthy, energized, and on track with your dietary goals.
      </p>
    </div>

    <div class="space-y-8 lg:grid lg:grid-cols-3 sm:gap-6 xl:gap-10 lg:space-y-0">

      {{-- Diet Plan --}}
      @include('components.meal_cards', [
          'title' => 'Diet Plan 1',
          'image' => 'assets/diet.jpg',
          'features' => [
              'Balanced meals for everyday health',
              'Supports weight management and wellness',
              'Includes a variety of fruits, vegetables, and whole grains'
          ]
      ])

      {{-- Protein Plan --}}
      @include('components.meal_cards', [
          'title' => 'Protein Plan 1',
          'image' => 'assets/protein.jpg',
          'features' => [
              'Lean, High-Protein Meals',
              'Balanced Macros with Good Fats & Greens',
              'Expert-Curated Weekly Recipes',
              'Clean Ingredients, No Compromise'
          ]
      ])

      {{-- Royal Plan --}}
      @include('components.meal_cards', [
          'title' => 'Royal Plan 1',
          'image' => 'assets/royal.jpg',
          'features' => [
              'Premium meals with gourmet ingredients',
              'Designed for those who appreciate fine dining',
              'Includes exotic and seasonal ingredients'
          ]
      ])

    </div>
  </section>

</body>
</html>

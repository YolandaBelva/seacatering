<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Customize Your Meal Plan</title>
  <link rel="stylesheet" href="{{ asset('css/style.css') }}">
</head>
<body>
  <div class="container">
    <h1>Customize Your Meal Plan</h1>
    
    <form method="POST" action="{{ route('subscription') }}">
      <label for="name">Name*</label>
      <input type="text" id="name" placeholder="Enter your name" required>

      <label for="phone">Phone Number*</label>
      <input type="tel" id="phone" placeholder="Enter your phone number" required>

      <div class="plan-section">
        <label>Plan</label>
        <div class="plan-option">
          <input type="radio" id="diet" name="plan" value="Diet" checked>
          <label for="diet">
            <strong>Diet Plan</strong><br>
            <span>Balanced meals for everyday health</span>
          </label>
        </div>
        <div class="plan-option">
          <input type="radio" id="protein" name="plan" value="Protein">
          <label for="protein">
            <strong>Protein Plan</strong><br>
            <span>High-protein meals for fitness enthusiasts</span>
          </label>
        </div>
        <div class="plan-option">
          <input type="radio" id="royal" name="plan" value="Royal">
          <label for="royal">
            <strong>Royal Plan</strong><br>
            <span>Premium meals with gourmet ingredients</span>
          </label>
        </div>
      </div>

      <div class="checkbox-group">
        <label>Select Meal Types (at least 1)</label>
        <div class="checkboxes">
          <label><input type="checkbox" name="meal-type"> Breakfast</label>
          <label><input type="checkbox" name="meal-type"> Lunch</label>
          <label><input type="checkbox" name="meal-type"> Dinner</label>
        </div>
      </div>

      <div class="checkbox-group">
        <label>Select Delivery Days</label>
        <div class="checkboxes">
          <label><input type="checkbox" name="delivery-day"> Monday</label>
          <label><input type="checkbox" name="delivery-day"> Tuesday</label>
          <label><input type="checkbox" name="delivery-day"> Wednesday</label>
          <label><input type="checkbox" name="delivery-day"> Thursday</label>
          <label><input type="checkbox" name="delivery-day"> Friday</label>
          <label><input type="checkbox" name="delivery-day"> Saturday</label>
          <label><input type="checkbox" name="delivery-day"> Sunday</label>
        </div>
      </div>

      <label for="allergies">Allergies (optional)</label>
      <textarea id="allergies" placeholder="Type any allergies here..."></textarea>

      <div class="price-info">
        <strong>Price Calculation</strong><br>
        Total Price = Plan Price × Number of Meal Types × Number of Delivery Days × 4.3<br />
        <small>Example: Diet Plan (IDR 150,000) × 2 Meal Types × 5 Delivery Days × 4.3 = IDR 6,450,000</small>
      </div>

      <button type="submit">Subscribe</button>
    </form>
  </div>
</body>
</html>

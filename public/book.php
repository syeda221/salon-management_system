<?php include '../config/connect.php';
$conn=(new database)->connection();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">
<title>Book Appointment</title>
<link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@500;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet">
<style>
  *, *::before, *::after { box-sizing: border-box; margin: 0; padding: 0; }

  body {
    min-height: 100vh;
    background: #f5f0eb;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 40px 16px;
    /* font-family: 'DM Sans', sans-serif; */
    color: #1a1a1a;
  }

  .card {
    background: #fff;
    border-radius: 20px;
    padding: 48px 44px;
    width: 100%;
    max-width: 520px;
    box-shadow: 0 8px 40px rgba(0,0,0,0.08);
  }

  .card-header {
    margin-bottom: 36px;
    text-align: center;
  }

  .card-header span {
    display: inline-block;
    background: #f0ebe4;
    color: #a0845c;
    font-size: 11px;
    font-weight: 500;
    letter-spacing: 2px;
    text-transform: uppercase;
    padding: 6px 14px;
    border-radius: 20px;
    margin-bottom: 12px;
  }

  h2 {
    /* font-family: 'Playfair Display', serif; */
    font-size: 2rem;
    font-weight: 700;
    color: #1a1a1a;
    line-height: 1.2;
  }

  .form-row {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 16px;
  }

  .form-group {
    margin-bottom: 20px;
  }

  label {
    display: block;
    font-size: 12px;
    font-weight: 500;
    letter-spacing: 1px;
    text-transform: uppercase;
    color: #888;
    margin-bottom: 8px;
  }

  input[type="text"],
  input[type="email"],
  input[type="tel"],
  input[type="date"],
  select {
    width: 100%;
    padding: 12px 16px;
    border: 1.5px solid #e8e2db;
    border-radius: 10px;
    font-family: 'DM Sans', sans-serif;
    font-size: 15px;
    color: #1a1a1a;
    background: #fdfcfb;
    transition: border-color 0.2s, box-shadow 0.2s;
    outline: none;
    appearance: none;
    -webkit-appearance: none;
  }

  input:focus, select:focus {
    border-color: #c9a87a;
    box-shadow: 0 0 0 3px rgba(201,168,122,0.15);
    background: #fff;
  }

  .select-wrapper {
    position: relative;
  }

  .select-wrapper::after {
    content: '▾';
    position: absolute;
    right: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #aaa;
    pointer-events: none;
  }

  .divider {
    height: 1px;
    background: #f0ebe4;
    margin: 28px 0;
  }

  h3 {
    /* font-family: 'Playfair Display', serif; */
    font-size: 1.15rem;
    font-weight: 500;
    margin-bottom: 16px;
    color: #333;
  }

  .services-grid {
    display: grid;
    grid-template-columns: 1fr 1fr;
    gap: 10px;
    margin-bottom: 28px;
  }

  .service-item {
    display: flex;
    align-items: center;
    gap: 10px;
    padding: 12px 14px;
    border: 1.5px solid #e8e2db;
    border-radius: 10px;
    cursor: pointer;
    transition: border-color 0.2s, background 0.2s;
    font-size: 14px;
  }

  .service-item:hover {
    border-color: #c9a87a;
    background: #fdf9f5;
  }

  .service-item input[type="checkbox"] {
    width: 16px;
    height: 16px;
    accent-color: #c9a87a;
    cursor: pointer;
    flex-shrink: 0;
  }

  button[type="submit"] {
    width: 100%;
    padding: 15px;
    background: #1a1a1a;
    color: #fff;
    border: none;
    border-radius: 12px;
    font-family: 'DM Sans', sans-serif;
    font-size: 15px;
    font-weight: 500;
    letter-spacing: 0.5px;
    cursor: pointer;
    transition: background 0.2s, transform 0.1s;
  }

  button[type="submit"]:hover {
    background: #c9a87a;
  }

  button[type="submit"]:active {
    transform: scale(0.99);
  }

  @media (max-width: 480px) {
    .card { padding: 32px 24px; }
    .form-row, .services-grid { grid-template-columns: 1fr; }
  }
</style>
</head>
<body>

<div class="card">
  <div class="card-header">
    <span>Schedule</span>
    <h2>Book an Appointment</h2>
  </div>

  <form action="submit.php" method="POST">

    <div class="form-row">
      <div class="form-group">
        <label for="name">Full Name</label>
        <input type="text" id="name" name="name" placeholder="Jane Smith" required>
      </div>
      <div class="form-group">
        <label for="phone">Phone</label>
        <input type="tel" id="phone" name="phone" placeholder="+1 234 567 890" required>
      </div>
    </div>

    <div class="form-group">
      <label for="email">Email Address</label>
      <input type="email" id="email" name="email" placeholder="jane@example.com" required>
    </div>

    <div class="form-row">
      <div class="form-group">
        <label for="date">Preferred Date</label>
        <input type="date" id="date" name="date" required>
      </div>
      <div class="form-group">
        <label for="slot_id">Time Slot</label>
        <div class="select-wrapper">
          <select id="slot_id" name="slot_id">
            <?php foreach($conn->query("SELECT * FROM time_slots") as $t): ?>
              <option value="<?= $t['id'] ?>"><?= $t['slot_time'] ?></option>
            <?php endforeach; ?>
          </select>
        </div>
      </div>
    </div>

    <div class="divider"></div>

    <h3>Select Services</h3>
    <div class="services-grid">
      <?php foreach($conn->query("SELECT * FROM services") as $s): ?>
        <label class="service-item">
          <input type="checkbox" name="services[]" value="<?= $s['id'] ?>">
          <?= htmlspecialchars($s['service_name']) ?>
        </label>
      <?php endforeach; ?>
    </div>

    <button type="submit">Confirm Booking →</button>

  </form>
</div>

</body>
</html>
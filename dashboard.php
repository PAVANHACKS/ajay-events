<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Ajay Events - Home</title>

  <!-- Fonts & Icons -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@400;600&display=swap" rel="stylesheet"/>

  <style>
    * {
      margin: 0;
      padding: 0;
      box-sizing: border-box;
      font-family: 'Poppins', sans-serif;
    }

    body {
      background-color: #f9f9f9;
      overflow-x: hidden;
    }

    /* ✅ Header */
    header {
      background: white;
      padding: 15px 30px;
      box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
      display: flex;
      justify-content: space-between;
      align-items: center;
      position: sticky;
      top: 0;
      z-index: 10;
    }

    nav a {
      margin: 0 15px;
      text-decoration: none;
      color: black;
      font-weight: 500;
      transition: color 0.3s;
    }

    nav a:hover {
      color: #e91e63;
    }

    .logo {
      height: 50px;
      cursor: pointer;
    }

    /* ✅ Image Scroll Section */
    .image-scroll-section {
      width: 100%;
      height: 60vh;
      overflow: hidden;
      position: relative;
      margin-bottom: 40px;
    }

    .scroll-wrapper {
      display: flex;
      width: max-content;
      height: 100%;
    }

    .image-caption-wrapper {
      position: relative;
      width: 100vw;
      height: 60vh;
      flex-shrink: 0;
      overflow: hidden;
    }

    .image-caption-wrapper img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }

    .caption {
      position: absolute;
      bottom: 20px;
      left: 30px;
      color: white;
      font-size: 1.5rem;
      font-weight: 600;
      text-shadow: 2px 2px 6px rgba(0, 0, 0, 0.7);
      opacity: 0;
      transition: opacity 0.5s ease;
    }

    .image-caption-wrapper:hover .caption {
      opacity: 1;
    }

    .scroll-left .scroll-wrapper {
      animation: scrollImagesLTR 60s linear infinite;
    }

    .scroll-right .scroll-wrapper {
      animation: scrollImagesRTL 60s linear infinite;
    }

    .scroll-left:hover .scroll-wrapper,
    .scroll-right:hover .scroll-wrapper {
      animation-play-state: paused;
    }

    @keyframes scrollImagesLTR {
      0% { transform: translateX(0); }
      100% { transform: translateX(-50%); }
    }

    @keyframes scrollImagesRTL {
      0% { transform: translateX(-50%); }
      100% { transform: translateX(0); }
    }

    /* ✅ Services Section */
    .services-section {
      padding: 40px 30px;
      background-color: white;
      max-width: 1200px;
      margin: 0 auto 60px auto;
      border-radius: 8px;
      box-shadow: 0 4px 20px rgba(0,0,0,0.05);
    }

    .services-section .section-title {
      text-align: center;
      font-size: 2.5rem;
      font-weight: 700;
      margin-bottom: 30px;
      color: #e91e63;
    }

    .services-grid {
      display: grid;
      grid-template-columns: repeat(auto-fit, minmax(220px, 1fr));
      gap: 24px;
    }

    .service-card {
      background-color: #fce4ec;
      border-radius: 12px;
      padding: 30px 20px;
      text-align: center;
      font-weight: 600;
      font-size: 1.2rem;
      color: #880e4f;
      box-shadow: 0 2px 8px rgba(232, 96, 144, 0.2);
      transition: background-color 0.3s, box-shadow 0.3s;
      display: flex;
      flex-direction: column;
      align-items: center;
      gap: 15px;
    }

    .service-card i {
      font-size: 3rem;
      color: #d81b60;
    }

    .service-card:hover {
      background-color: #f8bbd0;
      box-shadow: 0 6px 15px rgba(232, 96, 144, 0.4);
    }

    /* ✅ Footer */
    footer {
      text-align: center;
      padding: 20px;
      background-color: #f1f1f1;
      font-size: 14px;
    }

    /* ✅ WhatsApp Floating Button */
    .fixed-whatsapp-button {
      position: fixed;
      bottom: 20px;
      right: 20px;
      z-index: 1000;
      background-color: #25D366;
      color: white;
      width: 60px;
      height: 60px;
      border-radius: 50%;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 28px;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      transition: transform 0.2s;
    }

    .fixed-whatsapp-button:hover {
      transform: scale(1.1);
      cursor: pointer;
    }

    /* ✅ Chat With Us Button */
    .fixed-chat-button {
      position: fixed;
      bottom: 20px;
      left: 20px;
      z-index: 1000;
      background-color: #2196f3;
      color: white;
      padding: 12px 18px;
      border-radius: 30px;
      font-size: 15px;
      font-weight: 600;
      text-decoration: none;
      box-shadow: 0 4px 8px rgba(0,0,0,0.2);
      transition: transform 0.2s, background 0.3s;
    }

    .fixed-chat-button:hover {
      transform: scale(1.08);
      background-color: #0d8bf2;
    }

    /* ✅ Notification Box */
    .notification-box {
      position: fixed;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      background-color: #ffffff;
      color: #333;
      padding: 25px 30px;
      border-left: 5px solid #2196f3;
      border-radius: 12px;
      box-shadow: 0 8px 20px rgba(0, 0, 0, 0.25);
      z-index: 9999;
      display: none;
      max-width: 350px;
      width: 90%;
      animation: slideInNotification 0.4s ease-out forwards;
      text-align: center;
    }

    .notification-box p {
      margin: 0 0 15px;
      font-size: 15px;
      font-weight: 500;
    }

    .notification-actions {
      display: flex;
      justify-content: center;
      gap: 12px;
      flex-wrap: wrap;
    }

    .notify-btn {
      background-color: #25D366;
      color: white;
      text-decoration: none;
      padding: 8px 14px;
      border-radius: 5px;
      font-size: 14px;
      transition: background 0.3s;
    }

    .notify-btn:hover {
      background-color: #1ebe5d;
    }

    .close-btn {
      position: absolute;
      top: 10px;
      right: 15px;
      font-size: 18px;
      cursor: pointer;
      color: #999;
    }

    .close-btn:hover {
      color: #000;
    }

    @keyframes slideInNotification {
      from { opacity: 0; transform: translate(-50%, -60%); }
      to { opacity: 1; transform: translate(-50%, -50%); }
    }
  </style>
</head>
<body>

  <!-- ✅ Notification Popup -->
  <div id="contactNotification" class="notification-box">
    <span class="close-btn" onclick="closeNotification()">✖</span>
    <p>Feel free to contact us for more booking and details.</p>
    <div class="notification-actions">
      <a href="https://wa.me/919390365070" target="_blank" class="notify-btn">WhatsApp</a>
      <a href="tel:+919390365070" class="notify-btn">Call Now</a>
    </div>
  </div>

  <!-- ✅ Header -->
  <header>
    <img src="https://logos.textgiraffe.com/logos/logo-name/42503404-designstyle-bazinga-l.png"
         class="logo"
         alt="Ajay Events Logo"
         onclick="window.location.href = window.location.href;">
    <nav>
      <a href="#">Home</a>
      <a href="aboutus.html">About Us</a>
      <a href="Services.html">Services</a>
      <a href="Gallery.html">Gallery</a>
      <a href="Contact.html">Contact</a>
      <a href="Request Quote.html" style="font-weight: bold; text-decoration: underline;">Request Quote</a>
    </nav>
  </header>

  <!-- 🔼 Top Scrolling Section -->
  <section class="image-scroll-section scroll-left">
    <div class="scroll-wrapper">
      <div class="image-caption-wrapper">
        <img src="https://i.pinimg.com/originals/4d/05/7c/4d057cd3c262034a2be99b30199fbd61.jpg" />
        <div class="caption">Royal Stage Setup</div>
      </div>
      <div class="image-caption-wrapper">
        <img src="https://i.pinimg.com/originals/41/ed/75/41ed7593363a5a13154573673da5f762.jpg" />
        <div class="caption">Traditional Theme Decor</div>
      </div>
      <div class="image-caption-wrapper">
        <img src="https://i.ytimg.com/vi/cjPirMe38II/maxresdefault.jpg" />
        <div class="caption">Engagement Backdrop</div>
      </div>
      <div class="image-caption-wrapper">
        <img src="https://i.ytimg.com/vi/SxXYBr4WhYc/maxresdefault.jpg" />
        <div class="caption">Couple Entry Decor</div>
      </div>
      <div class="image-caption-wrapper">
        <img src="https://wallpaperaccess.com/full/5174643.jpg" />
        <div class="caption">Wedding Stage Lighting</div>
      </div>
    </div>
  </section>

  <!-- 🔽 Bottom Scrolling Section -->
  <section class="image-scroll-section scroll-right">
    <div class="scroll-wrapper">
      <div class="image-caption-wrapper">
        <img src="https://anilevents.in/wp-content/uploads/2020/02/Beautiful-Flower-Decoration.jpg" />
        <div class="caption">Floral Decorations</div>
      </div>
      <div class="image-caption-wrapper">
        <img src="https://i.pinimg.com/originals/23/9a/96/239a96acc9c4f5dc7e75ffdc291043a2.jpg" />
        <div class="caption">Elegant Night View</div>
      </div>
      <div class="image-caption-wrapper">
        <img src="https://as1.ftcdn.net/v2/jpg/02/85/16/32/1000_F_285163203_idtMHwkK28kxOGOLmDW1sFB206dlc40B.jpg" />
        <div class="caption">Stage Ready Moment</div>
      </div>
    </div>
  </section>

  <!-- ✅ Services Section (Updated with link) -->
 <!-- ✅ Services Section -->
<!-- ✅ Services Section -->
<section class="services-section">
  <h2 class="section-title" style="text-align:center; font-size:2rem; font-weight:bold; color:#333; margin-bottom:20px;">
    Our Services
  </h2>
  <div class="services-grid">
    <a href="wedding-decor.html" class="service-card"><i class="fas fa-church"></i> Wedding Decor</a>
    <a href="wedding-management.html" class="service-card"><i class="fas fa-ring"></i> Wedding Management</a>
    <a href="birthday.html" class="service-card"><i class="fas fa-birthday-cake"></i> Birthday Events</a>
    <a href="conference.html" class="service-card"><i class="fas fa-briefcase"></i> Conference Management</a>
    <a href="award.html" class="service-card"><i class="fas fa-award"></i> Award Ceremonies</a>
    <a href="dj.html" class="service-card"><i class="fas fa-music"></i> DJ Nights</a>
    <a href="housing.html" class="service-card"><i class="fas fa-home"></i> Housing Ceremony</a>
    <a href="farewell.html" class="service-card"><i class="fas fa-school"></i> School & College Farewells</a>
    <a href="festival.html" class="service-card"><i class="fas fa-flag"></i> Festival Celebrations</a>
    
    <!-- ✅ Newly Added Services -->
    <a href="catering.html" class="service-card"><i class="fas fa-utensils"></i> Catering Services</a>
    <a href="photography.html" class="service-card"><i class="fas fa-camera"></i> Photography & Videography</a>
    <a href="band.html" class="service-card"><i class="fas fa-drum"></i> Band Music</a>
  </div>
</section>



  <!-- ✅ Footer -->
  <footer>
    &copy; 2025 Ajay Events. All rights reserved.
  </footer>

  <!-- ✅ WhatsApp Button -->
  <a href="https://wa.me/919390365070?text=Hi%20Ajay%20Events%2C%20I%20would%20like%20to%20book%20an%20event!"
     target="_blank"
     class="fixed-whatsapp-button"
     title="Chat with us on WhatsApp">
    <i class="fab fa-whatsapp"></i>
  </a>

  <!-- ✅ Chat With Us Button -->
  <a href="mailto:ajayevents@example.com"
     target="_blank"
     class="fixed-chat-button"
     title="Chat with us">
     💬 Chat With Us
  </a>

  <!-- ✅ JS -->
  <script>
    function showNotification() {
      document.getElementById('contactNotification').style.display = 'block';
    }
    function closeNotification() {
      document.getElementById('contactNotification').style.display = 'none';
    }
    window.addEventListener('load', () => {
      setTimeout(showNotification, 3000);
    });
  </script>

</body>
</html>

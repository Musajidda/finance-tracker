<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Document</title>

    <style>
        
        nav {
           
           padding: 30px;
           display: flex;
           justify-content: end;
           color: green;

       }

       nav ul {
           list-style-type: none;
           padding: 0;
           margin: 0;
           display: flex;
           color: green;
       }

       nav ul li {
           margin: 0 15px;
       }

       nav ul li a {
           color: white;
           text-decoration: none;
           font-size: 22px;
           padding: 10px 15px;
           border-radius: 5px;
           color: green;
         
       }

       nav ul li a:hover {
           background-color: green;
           color: white;
       }

              .banner {
    width: 100%;
    height: 220px;
    background: linear-gradient(to right, green,green); /* A blue gradient */
    color: white;
    text-align: center;
    padding: 30px 50px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.banner h1 {
    margin: 0;
    font-size: 80px;
    font-weight: bold;
}

.banner h4 {
    margin-top: 10px;
    font-size: 28px;
    
}
.sub-banner {
    width: 100%;
    height: 20px;
    background: linear-gradient(to right, green,green); /* A blue gradient */
    color: white;
    text-align: center;
    padding: 30px 50px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
}

.sub-banner h4 {
    margin: 0;
    font-size: 30px;
    font-weight: bold;
   
    text-shadow: 0 0 10px rgba(36, 245, 78, 0.89);
}
.two-column {
    display: flex;
    flex-wrap: wrap;
    justify-content: space-between;
    align-items: center;
    padding: 20px 20px;
    
   
    margin: 0 auto;
    gap: 10px;
}

.text-column {
    flex: 1;
    min-width: 200px;
    margin: 20PX auto;
}



.text-column p {
    font-size: 25px;
    line-height: 1.9;
}

.video-column {
    flex: 1;
    min-width: 300px;
}

.video-column video {
    width: 100%;
    border-radius: 10px;
    box-shadow: 0 5px 20px rgba(0,0,0,0.1);
}
.text p{
width: 100%;
font-size: 25px;
line-height: 1.6;
}
.text h1{
    font-size: 40px;
    font-weight: bold;
    text-align: center;
    margin: 20px 0;

}
.container {
      display: flex;
      align-items: flex-start;
      padding: 70px;
      gap: 10px;
    }

    

    .content-section {
      flex: 1;
      display: flex;
      flex-direction: column;
      gap: 15px;
    }

    .bannerr {
        width: 100%;
    height: 150px;
    background: linear-gradient(to right, green,green); /* A blue gradient */
    color: white;
    text-align: center;
    padding: 30px 50px;
    box-sizing: border-box;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    }

    .description {
      font-size: 25px;
      color: #333;
      max-width: 400px;
      line-height: 1.6;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        align-items: center;
      }

      .content-section {
        align-items: center;
        text-align: center;
      }

      .banner, .description {
        max-width: 80%;
      }
    }

    .containerr {
      display: flex;
      flex-wrap: wrap; /* allows wrapping */
      gap: 30px;
      padding: 20px;
      justify-content: center;
    }

    /* .video-section {
      flex: 1 1 200px;
      min-width: 40%;
      box-sizing: border-box;
      border: 2px solid green; /* ✅ Green border */
   
      
  

    .video-section video {
      width: 40%;
      max-width: 50%;
      border-radius: 10px;
    }

    .bannerrr {
      background-color: green;
      color: white;
      padding: 15px 20px;
      border-radius: 10px;
      font-size: 1.5rem;
      font-weight: bold;
      text-align: center;
      margin-bottom: 15px;
    }

    .descriptionn {
      font-size: 20px;
      color: #333;
      line-height: 1.6;
    }

    @media (max-width: 768px) {
      .container {
        flex-direction: column;
        align-items: center;
      }

      .content-sectionn, .video-section {
        width: 100%;
      }

      .bannerrr {
        width: 100%;
      }

      .descriptionn {
        text-align: center;
      }
    }
    </style>
</head>
<body>
     <!-- Navigation Bar -->
     <nav>
        <ul>
            <li><a href="dashboard.php">Home</a></li>
            <li><a href="moneytimeline.php">MoneyTimeline</a></li>
            <li><a href="opportunities.php">Opportunities</a></li>
            <li><a href="quiz.php">Quiz</a></li>
            <li><a href="planner.php">Planner</a></li>
            <li><a href="tracker.php">Tracker</a></li>
            <li><a href="profile.php">Profile</a></li>
        </ul>
    </nav>

   <main>
    <!-- Banner Section -->
<div class="banner">
    <h1>Unlock Digital Money-Making Opportunities</h1>
    <h4>Explore modern ways to earn in today’s digital economy</h4>
</div>
<br>
<div class="sub-banner">
    <h4>Discover the endless opportunities</h4>
   
</div>
<div class="two-column">
    <div class="text-column">
        <p>
        The internet has transformed how people around the world earn a living. Today, from the comfort of your home, you can tap into countless digital opportunities 
        that were once out of reach. Whether you’re starting a freelance career, launching an online store, sharing your creativity as a content creator, or exploring crypto markets, the digital world offers
         unlimited potential. With the right knowledge and tools, anyone can leverage these platforms to create multiple income streams and build financial freedom.
        </p>
    </div>
    <div class="video-column">
      
           <img src="assets/opportunities/image1.png" alt="" width="90%">
           
    </div>
</div>
<div class="text">
    <h1>Explore Lucrative Digital Avenues</h1>
    <p>In today’s world, the internet has created countless ways for individuals to earn income beyond traditional jobs. The shift to digital platforms means that people can now access global markets, offer their skills, or sell products and services to customers worldwide. From freelancing and online business to digital content creation and cryptocurrency trading, the digital economy has unlocked doors for people of all backgrounds to build flexible, scalable sources of income. Whether you want to work independently, start a side hustle, or build a full-time business, these digital avenues provide real opportunities to grow your finances and achieve financial independence.</h4>
</div>
<div class="sub-banner">
    <h4>Freelancing</h4>
   
</div>
<div class="container">
  <div class="video-section">
    <video controls>
      <source src="assets/videos/Freelancing.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
  </div>
  <div class="content-section">
    <div class="bannerr">
        <h1> Freelance your way</h1>
   </div>
    <div class="description">
    Freelancing is one of the most popular ways to earn money online. It allows individuals to offer their skills and services directly to clients across the globe without being tied to a traditional job. Whether you are a writer, graphic designer, web developer, translator, or virtual assistant, freelancing gives you the freedom to choose your projects, set your rates, and work remotely.
Today, platforms like Upwork, Fiverr, and Freelancer.com connect freelancers with businesses and individuals looking for specific services. Freelancing is ideal for those who want flexible work hours and the ability to build a diverse portfolio while earning.

    </div>
  </div>
</div>
<div class="sub-banner">
    <h4>Content Creation</h4>
   
</div>
<div class="containerr">
  <div class="video-sectionn">
    <video controls>
      <source src="assets/videos/CCreation.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
  </div>
  <div class="content-sectionn">
    <div class="bannerrr">
        <h1>Content Creation</h1>
    </div>
    <div class="descriptionn">
    Content creation involves producing and sharing valuable content to engage an audience. This could be through blogging, video production (e.g., YouTube), podcasting, or social media platforms like Instagram, TikTok, or LinkedIn.
As a content creator, you can monetize your work through ads, sponsorships, affiliate marketing, or selling digital products. Content creation allows individuals to turn their creativity and knowledge into income while building a personal or business brand.

    </div>
  </div>
</div>

<div class="sub-banner">
    <h4>E-Commerce</h4>
   
</div>
<div class="container">
  <div class="video-section">
    <video controls>
      <source src="assets/videos/Ecommerce.mp4" type="video/mp4">
      Your browser does not support the video tag.
    </video>
  </div>
  <div class="content-section">
    <div class="bannerr">
        <h1> Freelance your way</h1>
   </div>
    <div class="description">
    Freelancing is one of the most popular ways to earn money online. It allows individuals to offer their skills and services directly to clients across the globe without being tied to a traditional job. Whether you are a writer, graphic designer, web developer, translator, or virtual assistant, freelancing gives you the freedom to choose your projects, set your rates, and work remotely.
Today, platforms like Upwork, Fiverr, and Freelancer.com connect freelancers with businesses and individuals looking for specific services. Freelancing is ideal for those who want flexible work hours and the ability to build a diverse portfolio while earning.

    </div>
  </div>
</div>
</body>
</html>
<?php 

session_start();
if (!isset($_SESSION['username'])) {
    header('Location: ../login.html');
    exit();
}

date_default_timezone_set('Asia/Dhaka');

$current_hour = date('H');
//$greeting = 'Hello';

if ($current_hour >= 5 && $current_hour < 12) {
  $greeting = 'Good Morning';
} elseif ($current_hour >= 12 && $current_hour < 18) {
  $greeting = 'Good Afternoon';
} elseif ($current_hour >= 18 && $current_hour < 22) {
  $greeting = 'Good Evening';
} else {
  $greeting = 'Good Night';
}

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/tailwindcss@2.2.19/dist/tailwind.min.css" rel="stylesheet">
    <link rel="stylesheet" href="../css/bmi.css">
    <title>BMI Calculator</title>
</head>
<body class="bg-gray-100 font-sans">

    <?php include('partials/navbar.php'); ?>

    <div class="wrapper max-w-7xl mx-auto mt-8 p-4">
        <div class="hero_wrap flex flex-col lg:flex-row items-center">
            <div class="hero_intro text-center lg:text-left lg:mr-8">
                <h2 class="text-2xl font-bold">Welcome & <?php echo htmlspecialchars($greeting); ?> to BMI Smart Guide!</h2>
                <h3 class="text-lg mt-2">Currently logged in with: <span class="text-gray-700"><?php echo htmlspecialchars($_SESSION['username']); ?></span></h3>

                <ul class="list-none mt-6 p-0">
                  <li class="inline-block">
                      <a href="../update.html" class="bg-blue-900 text-white no-underline py-2 px-4 rounded-md hover:bg-blue-700 transition duration-300 ease-in-out">Update Profile</a>
                  </li>
               </ul>

                <h1 class="text-4xl font-bold mt-8">Body Mass<br />Index Calculator</h1>
                <p class="mt-4">
                    Better understand your weight in relation to your height using our
                    body mass index (BMI) calculator. While BMI is not the sole
                    determinant of a healthy weight, it offers a valuable starting point
                    to evaluate your overall health and well-being.
                </p>
            </div>
           

        <div class="bmi_calculator bg-white p-8 rounded-lg shadow-lg text-center w-11/12 max-w-lg mt-8 lg:mt-0">
                <h3 class="text-xl font-bold mb-4">Enter your details below</h3>
                <form action="bmi.php" method="post" id="form-group" class="flex flex-col items-center">
                    <div class="form-group flex justify-between w-full mb-4">
                        
                        <input type="text" id="name" name="name"  placeholder="Enter name"  required class="flex-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="form-group flex justify-between w-full mb-4">
                        
                        <input type="number" id="age" name="age"  placeholder="Enter age"  required class="flex-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="form-group flex justify-between w-full mb-4">
                       
                        <select id="gender" name="gender" required class="flex-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                           <option >Select gender</option>
                            <option value="Male">Male</option>
                            <option value="Female">Female</option>
                            <option value="Other">Other</option>
                        </select>
                    </div>

                    <div class="form-group flex justify-between w-full mb-4">
                         
                        <input type="number" id="height" name="height" placeholder="Enter height (in m)" step="0.01" required class="flex-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <div class="form-group flex justify-between w-full mb-4">
                       
                        <input type="number" id="weight" name="weight" placeholder="Enter weight (in kg )" step="0.1" required class="flex-2 shadow appearance-none border rounded w-full py-2 px-3 text-gray-700 leading-tight focus:outline-none focus:shadow-outline">
                    </div>

                    <button type="submit" class="w-11/12 h-10 mt-4 bg-blue-600 text-white font-bold py-0 px-4 rounded-full hover:opacity-90 focus:outline-none focus:shadow-outline">Calculate</button>
                </form>
            </div>
        </div>



        <div class="means_wrap flex flex-col lg:flex-row items-center mt-8">
            <div class="img_wrap">
                <img src="../images/eat.png" alt="woman" class="w-[300px] h-[300px]">
            </div>
            <div class="means_text lg:ml-8">
                <img src="./images/pattern-curved-line-left.svg" alt="" class="pattern1">
                <h1 class="text-4xl font-bold">What your BMI result means</h1>
                <p class="mt-4">
                    A BMI range of 18.5 to 24.9 is considered a 'healthy weight.'
                    Maintaining a healthy weight may lower your chances of experiencing
                    health issues later on, such as obesity and type 2 diabetes. Aim for
                    a nutritious diet with reduced fat and sugar content, incorporating
                    ample fruits and vegetables. Additionally, strive for regular
                    physical activity, ideally about 30 minutes daily for five days a
                    week.
                </p>
            </div>
        </div>

        <div class="bmi_components_wrap mt-8">
            <div class="component mb-8">
                <h3 class="text-2xl font-bold">Healthy eating</h3>
                <p class="mt-2">
                    Healthy eating promotes weight control, disease prevention, better
                    digestion, immunity, mental clarity, and mood.
                </p>
            </div>
            <div class="component mb-8">
                <h3 class="text-2xl font-bold">Regular exercise</h3>
                <p class="mt-2">
                    Exercise improves fitness, aids weight control, elevates mood, and
                    reduces disease risk, fostering wellness and longevity.
                </p>
            </div>
            <div class="component mb-8">
                <h3 class="text-2xl font-bold">Adequate sleep</h3>
                <p class="mt-2">
                    Sleep enhances mental clarity, emotional stability, and physical
                    wellness, promoting overall restoration and rejuvenation.
                </p>
            </div>
        </div>

        <div class="limitations_wrap mt-8">
            <div class="limotations_text">
                <h1 class="text-4xl font-bold">Limitations of BMI</h1>
                <p class="mt-4">
                    Although BMI is often a practical indicator of healthy weight, it is
                    not suited for every person. Specific groups should carefully
                    consider their BMI outcomes, and in certain cases, the measurement
                    may not be beneficial to use.
                </p>
                <img src="./images/pattern-curved-line-right.svg" alt="">
            </div>
            <div class="blocks_limit flex flex-wrap mt-8">
                <div class=" box1 elements w-full lg:w-1/2 p-4 ml-8" >
                    <div class="important flex items-center mb-4">
                        <img src="./images/icon-gender.svg" alt="" class="mr-4">
                        <h3 class="text-2xl font-bold">Gender</h3>
                    </div>
                    <p>
                        The development and body fat composition of girls and boys vary
                        with age. Consequently, a child's age and gender are considered
                        when evaluating their BMI.
                    </p>
                </div>
                <div class="elements w-full lg:w-1/2 p-4">
                    <div class="important flex items-center mb-4">
                        <img src="./images/icon-age.svg" alt="" class="mr-4">
                        <h3 class="text-2xl font-bold">Age</h3>
                    </div>
                    <p>
                        In aging individuals, increased body fat and muscle loss may cause
                        BMI to underestimate body fat content.
                    </p>
                </div>
                <div class="elements w-full lg:w-1/2 p-4">
                    <div class="important flex items-center mb-4">
                        <img src="./images/icon-muscle.svg" alt="" class="mr-4">
                        <h3 class="text-2xl font-bold">Muscle</h3>
                    </div>
                    <p>
                        BMI may misclassify muscular individuals as overweight or obese, as
                        it doesn't differentiate muscle from fat.
                    </p>
                </div>
                
                <div class="elements w-full lg:w-1/2 p-4">
                    <div class="important flex items-center mb-4">
                        <img src="./images/icon-race.svg" alt="" class="mr-4">
                        <h3 class="text-2xl font-bold">Race</h3>
                    </div>
                    <p>
                        Certain health concerns may be associated with BMI interpretation
                        among people of different racial and ethnic backgrounds. For
                        instance, adults of Asian descent may have an increased risk of
                        health issues at lower BMI levels, compared to others.
                    </p>
                </div>
            </div>
        </div>

        <?php include('partials/footer.php'); ?>
        
    </div>
</body>
</html>

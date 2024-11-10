@include('components.header-footer')
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>TechXpertz</title>
    <link rel="icon" href="{{ asset('images/TechXpertz-Icon.ico') }}">

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.2/css/all.min.css" integrity="sha512-SnH5WK+bZxgPHs44uWIX+LLJAJ9/2PkPKZ5QiAj6Ta86w+fsb2TkcmfRyVX3pBnMFcV7oQPJkl9QevSCWr3W6A==" crossorigin="anonymous" referrerpolicy="no-referrer" />
    <link rel="stylesheet" href="{{ asset('css/Customer/customer-headerfooter.css') }}">
    <link rel="stylesheet" href="{{ asset('css/Customer/customer-loadingscreen.css') }}">

    
    <link rel="stylesheet" href="{{ asset('css/Customer/10 - AboutUs.css') }}">
</head>
<body>
    @yield('header')
    <div class="container container-1" style="background-image:url({{asset('images/about-bg.png')}});">
        <h1>Tech<span>X</span>pertz</h1>
        <p>TechXpertz is a comprehensive platform designed to connect customers with reliable and skilled technicians for electronic repairs. By bringing transparency and efficiency to the repair process, TechXpertz simplifies finding trusted repair services for devices like smartphones, laptops, and other electronics. Through an intuitive interface, customers can browse local repair shops, book appointments, communicate directly with technicians, and track repair progress in real-time. TechXpertz prioritizes quality and trust, allowing users to review service history, read customer feedback, and access a streamlined repair experience. The platform aims to enhance customer satisfaction and support technicians in providing top-tier repair services.</p>
    </div>
    <div class="container container-2">
        <img src="{{ asset('images/developers/Iverson.jpg') }}" alt="">
        <div class="details">
            <h2>Founder/Developer</h2>
            <h1>Iverson Craig G. Guno</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus harum totam numquam possimus illo, nihil quae sunt eum atque consequuntur, fuga quasi ratione sapiente voluptates error molestiae tenetur et similique eius dolore aperiam qui vero architecto! Quo minima cumque corrupti provident, harum voluptas. Ipsa dignissimos ipsum provident vel a laborum recusandae corrupti dicta quos et repellendus, quibusdam, quod atque amet possimus officia aut sed cupiditate. Itaque quaerat adipisci odio quos.</p>
        </div>
    </div>

    <div class="container container-3">
        <img src="{{ asset('images/developers/Fatima.jpg') }}" alt="">
        <div class="details">
            <h2>Co-Founder/Project Manager</h2>
            <h1>Ma. Fatima C. Valiente</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus harum totam numquam possimus illo, nihil quae sunt eum atque consequuntur, fuga quasi ratione sapiente voluptates error molestiae tenetur et similique eius dolore aperiam qui vero architecto! Quo minima cumque corrupti provident, harum voluptas. Ipsa dignissimos ipsum provident vel a laborum recusandae corrupti dicta quos et repellendus, quibusdam, quod atque amet possimus officia aut sed cupiditate. Itaque quaerat adipisci odio quos.</p>
        </div>
    </div>

    <div class="container container-4">
        <img src="{{ asset('images/developers/Luis.jpg') }}" alt="">
        <div class="details">
            <h2>Core Team Member</h2>
            <h1>Luis Christian C. Santos</h1>
            <p>Lorem ipsum dolor sit amet consectetur adipisicing elit. Natus harum totam numquam possimus illo, nihil quae sunt eum atque consequuntur, fuga quasi ratione sapiente voluptates error molestiae tenetur et similique eius dolore aperiam qui vero architecto! Quo minima cumque corrupti provident, harum voluptas. Ipsa dignissimos ipsum provident vel a laborum recusandae corrupti dicta quos et repellendus, quibusdam, quod atque amet possimus officia aut sed cupiditate. Itaque quaerat adipisci odio quos.</p>
        </div>
    </div>
    @yield('footer')
    <script src="{{asset('js/Customer/header-footer.js')}}" defer></script>
    <script src="{{asset('js/Customer/customer-loadingscreen.js')}}" defer></script>
</body>
</html>
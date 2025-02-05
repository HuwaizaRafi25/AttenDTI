<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AttenDTI</title>
    <link rel="shortcut icon" href="{{ asset('assets/images/icons/dti_icon.png') }}" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    @vite(['resources/css/app.css', 'resources/js/app.js'])
    {{-- <script src="https://unpkg.com/@tailwindcss/browser@4"></script> --}}
    <style>
        body {
            background-image: url('{{ asset('assets/images/small_login_pic.jpg') }}');
            background-size: cover;
            background-repeat: no-repeat;
            background-position: center;
            height: 100vh;
            width: 100vw;
            overflow: hidden;
        }

        body::before {
            content: "";
            position: absolute;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-image: inherit;
            background-size: inherit;
            background-repeat: inherit;
            background-position: inherit;
            z-index: -1;
        }

        input:focus {
            border-color: #3b82f6;
            outline: none;
        }

        @media (min-width: 1024px) {
            body {
                background-image: none;
            }
        }

        .transition-smooth {
            transition: all 0.3s ease-in-out;
        }

        /* .notify {
            margin-top: 64px;
            z-index: 1000;
            align-items: flex-start !important;
        } */
    </style>
</head>

<body class="min-h-screen lg:bg-gray-50 flex flex-col lg:flex-row p-[3vh]">

    <img src="{{ asset('svg/pattern.svg') }}" class="lg:absolute hidden drop-shadow-lg lg:flex -bottom-10 left-0"
        alt="">
    <img src="{{ asset('svg/pattern2.svg') }}"
        class="lg:absolute hidden opacity-50 drop-shadow-lg lg:flex top-0 right-0 rotate-90" alt="">
    <img src="{{ asset('svg/pattern3.svg') }}"
        class="lg:absolute hidden opacity-85 drop-shadow-lg -top-40 left-[480px] rotate-[90deg] lg:flex" alt="">
    <img src="{{ asset('svg/pattern3.svg') }}"
        class="lg:absolute filter blur-lg hidden bottom-3 left-[420px] drop-shadow-lg transform -translate-x-1 rotate-[-90deg] lg:flex"
        alt="">

    <div
        class="min-h-screen absolute inset-0 lg:bg-transparent flex items-center justify-center bg-black/25 flex-col lg:flex-row p-[3vh] lg:backdrop-blur-none backdrop-blur-sm">


        <div
            class="lg:absolute hidden drop-shadow-lg lg:flex flex-col items-start top-4 left-4 justify-start lg:gap-2 lg:flex-row">
            <img src="{{ asset('assets/images/icons/dti_icon.png') }}" class="w-14 h-14" alt="ITB Logo">
            <span class="mt-3 flex text-2xl font-bold sm:text-3xl lg:text-2xl">
                <span class="text-[#9c9e9d]">
                    Atten
                </span>
                <span class="text-[#2daabd]">
                    DTI
                </span>
            </span>
        </div>
        <div
        class="lg:w-1/2 w-full flex flex-col items-center justify-center transition-smooth lg:relative absolute z-10 p-4 sm:p-6 lg:p-12">
        <div class="w-full max-w-md mx-auto">
            <div
                class="lg:hidden drop-shadow-sm flex flex-col items-center justify-start lg:gap-2 lg:flex-row lg:-top-16 lg:left-0 inset-0 lg:inset-auto">
                <img src="{{ asset('assets/images/icons/dti_icon.png') }}" class="w-24 h-24 lg:w-16 lg:h-16" alt="ITB Logo">
                <span class="mt-3 flex text-2xl font-bold sm:text-3xl lg:text-2xl">
                    <span class="text-[#9c9e9d]">
                        Atten
                    </span>
                    <span class="text-[#2daabd]">
                        DTI
                    </span>
                </span>
            </div>

            <div class="p-12">
        @yield('content')
    </div>
</div>
</div>


        <!-- Right Section -->
        <div class="relative lg:w-1/2 w-auto h-[94vh] inset-0 flex items-center justify-center lg:flex">
            <div class="relative">
                <!-- Gambar dengan efek brightness dan shadow -->
                <img src="{{ asset('svg/login_pic.svg') }}"
                    class="brightness-110 h-[94vh] hidden lg:block w-full transition-smooth drop-shadow-2xl"
                    alt="Login Background">

                <!-- Overlay Gradien Gelap di bawah Gambar -->
                <div
                    class="absolute inset-x-0 bottom-0 h-[40%] bg-gradient-to-t from-slate-50 to-transparent mix-blend-multiply">
                </div>
            </div>

            <div class="shadow-sm flex flex-col justify-center h-[94vh] lg:hidden max-w-2xl transition-smooth">
                <img src="{{ asset('svg/top_shape.svg') }}" class="min-w-[360px]">
                <div class="bg-white h-[60vh] min-w-[360px] relative overflow-hidden">
                    <img src="{{ asset('svg/pattern3.svg') }}"
                        class="absolute opacity-85 drop-shadow-lg -top-7 -right-[103px] transform transition-smooth scale-x-[-1] w-64 h-64 md:w-96 md:h-96 md:-top-20 md:-right-[156px]"
                        alt="">
                    <img src="{{ asset('svg/pattern.svg') }}"
                        class="absolute opacity-30 blur-md drop-shadow-lg -top-24 -left-[124px] transition-smooth w-64 h-64 md:w-96 md:h-96 md:-top-56 md:-left-[156px]"
                        alt="">
                    <img src="{{ asset('svg/pattern4.svg') }}"
                        class="absolute opacity-85 drop-shadow-lg bottom-2 -left-[103px] transition-smooth w-64 h-64 md:w-96 md:h-96 md:-left-[156px] md:bottom-4 "
                        alt="">
                </div>
                <img src="{{ asset('svg/bottom_shape.svg') }}" class="min-w-[360px]">
            </div>
        </div>
    </div>
    <script src="{{ asset('assets/js/togglePassword.js') }}"></script>
    <script src="{{ asset('assets/js/modalSuccess.js') }}"></script>
</body>
</html>


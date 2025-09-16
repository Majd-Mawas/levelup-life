<!DOCTYPE html>
<html lang="en">

<head>
    @include('layouts.shared/title-meta', ['title' => 'Login'])

    @include('layouts.shared/head-css')
</head>

<body>

    <div class=" dark:from-gray-700 dark:via-gray-900 dark:to-black">


        <div class="h-screen w-screen flex justify-center items-center">

            <div class="2xl:w-1/4 lg:w-1/3 md:w-1/2 w-full">
                <div class="card overflow-hidden sm:rounded-md rounded-none">
                    <div class="p-6">

                        <div class="logo-box">
                            <span class="font-nevan text-lg">LEVEL UP LIFE</span>
                        </div>


                        <form method="POST" action="{{ route('login') }}">
                            @csrf

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2"
                                    for="LoggingEmailAddress">Email Address</label>
                                <input id="LoggingEmailAddress" class="form-input" type="email"
                                    placeholder="Enter your email" name="email">
                            </div>

                            <div class="mb-4">
                                <label class="block text-sm font-medium text-gray-600 dark:text-gray-200 mb-2"
                                    for="loggingPassword">Password</label>
                                <input id="loggingPassword" class="form-input" type="password"
                                    placeholder="Enter your password" name="password">
                            </div>

                            <div class="flex justify-center mb-6">
                                <button class="btn w-full text-white bg-primary"> Log In</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>

    </div>

</body>

</html>

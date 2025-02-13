<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    @include('sweetalert::alert')

    @vite('resources/css/app.css')
    <title>Workshop Website</title>
</head>

<body>
    <div class="bg-bold-blue w-screen h-full lg:h-screen flex justify-center items-center text-[#343C53]">
        <div class="rounded-xl shadow-lg bg-white flex flex-col lg:flex-row p-8 w-[85%] h-full lg:h-[85%] ">
            <div class="w-full lg:w-[50%] flex flex-col items-center justify-center p-2 lg:p-12 space-y-4">
                <h1 class="text-3xl font-bold">
                    LOGIN
                </h1>
                <form id="sign-up" action="{{ route('login') }}" method="POST" class="w-full">
                    @csrf
                    <label for="credential" class="text-xl font-bold text-[#343C53]">Email</label>
                    <input type="email" name="email"
                        class="w-full h-[56px] border-2 rounded-lg px-4 text-xl text-[#343C53]  mb-4"
                        placeholder="Masukan Email">
                    <label for="password" class="text-xl font-bold text-[#343C53]">Password</label>
                    <input type="password" name="password"
                        class="w-full h-[56px] border-2 rounded-lg px-4 text-xl text-[#343C53] mb-10"
                        placeholder="Masukan Kata Sandi">
                    <div class="flex justify-center">
                        <button type="submit"
                            class="w-56 p-2 rounded-xl text-2xl text-white bg-bold-blue hover:bg-[#343C53]">MASUK</button>
                    </div>
                </form>
            </div>
            <div class="h-1 w-full lg:h-full lg:w-1 bg-slate-300 my-4 lg:my-0 lg:m-4 rounded-full"></div>
            <div class="w-full lg:w-[50%] flex flex-col items-center justify-center p-2 lg:p-12 space-y-4">
                <h1 class="text-3xl font-bold">REGISTER</h1>
                <form id="register-form" action="{{ route('register') }}" method="POST" class="w-full">
                    @csrf
                    <label for="name" class="text-xl font-bold text-[#343C53]">Nama</label>
                    <input type="text" name="name"
                        class="w-full h-[56px] border-2 rounded-lg px-4 text-xl text-[#343C53] mb-4"
                        placeholder="Masukan Nama" required>

                    <label for="email" class="text-xl font-bold text-[#343C53]">Email</label>
                    <input type="email" name="email"
                        class="w-full h-[56px] border-2 rounded-lg px-4 text-xl text-[#343C53] mb-4"
                        placeholder="Masukan Email" required>

                    <label for="password" class="text-xl font-bold text-[#343C53]">Password</label>
                    <input type="password" name="password"
                        class="w-full h-[56px] border-2 rounded-lg px-4 text-xl text-[#343C53] mb-4"
                        placeholder="Masukan Kata Sandi" required>

                    <label for="token" class="text-xl font-bold text-[#343C53]">Token Validasi</label>
                    <input type="password" name="token"
                        class="w-full h-[56px] border-2 rounded-lg px-4 text-xl text-[#343C53] mb-4"
                        placeholder="Masukan Token" required>

                    <div class="flex justify-center mt-4">
                        <button type="submit"
                            class="w-56 p-2 rounded-xl text-2xl text-white bg-bold-blue hover:bg-[#343C53]">DAFTAR</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</body>

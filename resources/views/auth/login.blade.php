<x-layout>
    <div class="flex min-h-[50vh] items-center justify-center px-2">
        <div class="w-full max-w-md">
            <div class="text-center">
                <h1 class="text-3xl font-bold tracking-tight">Log in</h1>
                <p class="text-xs text-muted-foreground mt-1 p-2 ">Welcome Back ;)</p>
                    <form method="POST" action="/login">
                        @csrf
                        <fieldset class="bg-base-200 rounded-box w-xs border-0 p-4 mx-auto text-left">

                            <x-forms.field fname="email" ftype="email" label="Email" required/>
                            <x-forms.field fname="password" ftype="password" label="Password"  required />

                            <button class="btn btn-neutral mt-4 w-full" data-test="login-button">Log In </button>
                        </fieldset>

                </form>
            </div>
        </div>
    </div>

</x-layout>

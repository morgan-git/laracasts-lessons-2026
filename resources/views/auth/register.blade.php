<x-layout>
    <div class="flex min-h-[50vh] items-center justify-center px-2">
        <div class="w-full max-w-md">
            <div class="text-center">
                <h1 class="text-sx1 font-bold tracking-tight">Register an account</h1>
                <p class="text-muted-foreground mt-1">Start tracking your ideas today</p>
                <form method="POST" action="/register" class="mt-10 space-y-4">
                    @csrf
                    <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4 mx-auto">

                        <x-forms.field fname="name" ftype="text" label="Name" required />
                        <x-forms.field fname="email" ftype="email" label="Email" required/>
                        <x-forms.field fname="password" ftype="password" label="Password"  required />

                        <button class="btn mt-4 h-12" data-test="register-button">Register</button>
                    </fieldset>

                </form>
            </div>
        </div>
    </div>
</x-layout>

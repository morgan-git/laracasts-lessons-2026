<x-layout>
    <form method="POST" action="/login">
        @csrf
        <fieldset class="fieldset bg-base-200 border-base-300 rounded-box w-xs border p-4 mx-auto">
            <legend class="fieldset-legend">Log In</legend>

            <label class="label" for="email">Email</label>
            <input type="email" class="input" placeholder="Your Email" name="email" required />
            <x-forms.error name="email" />

            <label class="label">Password</label>
            <input type="password" class="input" placeholder="Your Password" name="password" required />
            <x-forms.error name="password" />

            <button class="btn btn-neutral mt-4">Log In </button>
        </fieldset>

</form>

</x-layout>

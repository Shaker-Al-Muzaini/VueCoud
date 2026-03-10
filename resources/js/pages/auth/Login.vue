<script setup lang="ts">
import { Form, Head } from '@inertiajs/vue3';
import InputError from '@/components/InputError.vue';
import TextLink from '@/components/TextLink.vue';
import { Button } from '@/components/ui/button';
import { Checkbox } from '@/components/ui/checkbox';
import { Input } from '@/components/ui/input';
import { Label } from '@/components/ui/label';
import { Spinner } from '@/components/ui/spinner';
import AuthBase from '@/layouts/AuthLayout.vue';
import { register } from '@/routes';
import { store } from '@/routes/login';
import { request } from '@/routes/password';

defineProps<{
    status?: string;
    canResetPassword: boolean;
    canRegister: boolean;
}>();
function login(provider: string, event: Event) {
    event.preventDefault(); // يمنع الـ form من الإرسال
    window.location.href = `/login/${provider}`;
}
</script>

<template>
    <AuthBase
        title="Log in to your account"
        description="Enter your email and password below to log in"
    >
        <Head title="Log in" />

        <div
            v-if="status"
            class="mb-4 text-center text-sm font-medium text-green-600"
        >
            {{ status }}
        </div>

        <Form
            v-bind="store.form()"
            :reset-on-success="['password']"
            v-slot="{ errors, processing }"
            class="flex flex-col gap-6"
        >
            <div class="grid gap-6">
                <div class="grid gap-2">
                    <Label for="email">Email address</Label>
                    <Input
                        id="email"
                        type="email"
                        name="email"
                        required
                        autofocus
                        :tabindex="1"
                        autocomplete="email"
                        placeholder="email@example.com"
                    />
                    <InputError :message="errors.email" />
                </div>

                <div class="grid gap-2">
                    <div class="flex items-center justify-between">
                        <Label for="password">Password</Label>
                        <TextLink
                            v-if="canResetPassword"
                            :href="request()"
                            class="text-sm"
                            :tabindex="5"
                        >
                            Forgot password?
                        </TextLink>
                    </div>
                    <Input
                        id="password"
                        type="password"
                        name="password"
                        required
                        :tabindex="2"
                        autocomplete="current-password"
                        placeholder="Password"
                    />
                    <InputError :message="errors.password" />
                </div>

                <div class="flex items-center justify-between">
                    <Label for="remember" class="flex items-center space-x-3">
                        <Checkbox id="remember" name="remember" :tabindex="3" />
                        <span>Remember me</span>
                    </Label>
                </div>
                <div class="flex flex-col gap-3 mt-4">
                    <!-- GitHub -->
                    <Button
                        type="button"
                        variant="outline"
                        class="flex items-center justify-center gap-2 w-full bg-gray-800 text-white hover:bg-gray-900"
                        @click="login('github', $event)"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">
                            <path fill="currentColor" d="M12 0C5.37 0 0 5.373 0 12c0 5.303 3.438 9.8 8.205 11.385.6.113.82-.258.82-.577v-2.17c-3.338.725-4.033-1.61-4.033-1.61-.546-1.387-1.333-1.756-1.333-1.756-1.09-.744.083-.729.083-.729 1.205.084 1.84 1.236 1.84 1.236 1.07 1.835 2.807 1.305 3.492.997.108-.775.42-1.305.763-1.605-2.665-.3-5.467-1.332-5.467-5.931 0-1.31.467-2.38 1.235-3.22-.123-.303-.535-1.523.117-3.176 0 0 1.008-.322 3.3 1.23a11.44 11.44 0 0 1 3-.404c1.02.005 2.045.137 3 .404 2.28-1.552 3.285-1.23 3.285-1.23.655 1.653.243 2.873.12 3.176.77.84 1.23 1.91 1.23 3.22 0 4.61-2.807 5.625-5.48 5.921.432.37.816 1.1.816 2.222v3.293c0 .322.216.697.825.578C20.565 21.795 24 17.3 24 12c0-6.627-5.373-12-12-12z"/>
                        </svg>
                        Login with GitHub
                    </Button>

                    <!-- Google -->
                    <Button
                        type="button"
                        variant="outline"
                        class="flex items-center justify-center gap-2 w-full bg-red-600 text-white hover:bg-red-700"
                        @click="login('google', $event)"
                    >
                        <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" class="w-5 h-5">
                            <path fill="currentColor" d="M21.35 11.1h-9.36v2.79h5.36c-.23 1.37-1.41 4-5.36 4-3.21 0-5.83-2.64-5.83-5.88s2.62-5.88 5.83-5.88c1.83 0 3.05.79 3.75 1.48l2.55-2.49C18.77 3.2 16.9 2 13.99 2 7.62 2 2.99 6.63 2.99 12s4.63 10 11 10c6.34 0 10.55-4.44 10.55-10 0-.66-.06-1.17-.19-1.9z"/>
                        </svg>
                        Login with Google
                    </Button>

                    <!-- Facebook -->
                    <Button
                        type="button"
                        variant="outline"
                        class="flex items-center justify-center gap-2 w-full bg-blue-600 text-white hover:bg-blue-700"
                        @click="login('facebook', $event)"
                    >
                        Login with Facebook
                    </Button>
                </div>
                <Button
                    type="submit"
                    class="mt-4 w-full"
                    :tabindex="4"
                    :disabled="processing"
                    data-test="login-button"
                >
                    <Spinner v-if="processing" />
                    Log in
                </Button>
            </div>

            <div
                class="text-center text-sm text-muted-foreground"
                v-if="canRegister"
            >
                Don't have an account?
                <TextLink :href="register()" :tabindex="5">Sign up</TextLink>
            </div>
        </Form>
    </AuthBase>
</template>

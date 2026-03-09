import Echo from "laravel-echo";

export const echo = new Echo({
    broadcaster: "reverb",
    key: import.meta.env.VITE_REVERB_APP_KEY,
    wsHost: import.meta.env.VITE_REVERB_HOST ?? window.location.hostname,
    wsPort: Number(import.meta.env.VITE_REVERB_PORT) ?? 8080,
    forceTLS: false,
    enabledTransports: ["ws", "wss"],
});

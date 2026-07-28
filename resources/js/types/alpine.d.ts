declare global {
    interface Window {
        Alpine: typeof import('alpinejs')['default'];
    }
}

export {};

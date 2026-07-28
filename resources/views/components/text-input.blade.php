@props(['disabled' => false])

<input @disabled($disabled) {{ $attributes->merge(['class' => 'mt-1 block w-full rounded-lg border border-border dark:border-dark-border bg-white dark:bg-dark-surface px-4 py-2.5 text-sm text-gray-900 dark:text-dark-text shadow-sm focus:border-primary-500 focus:ring-primary-500/20']) }}>

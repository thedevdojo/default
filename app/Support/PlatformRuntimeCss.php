<?php

namespace App\Support;

/**
 * Composes the app's stylesheet for the DevDojo platform runtime, where
 * Tailwind compiles in the browser (@tailwindcss/browser) instead of at
 * build time. Serving `resources/css/app.css` straight into a
 * `type="text/tailwindcss"` block keeps the design tokens live: when the
 * AI (or you) edits the CSS, the next paint reflects it — no npm build.
 *
 * Three transforms make the source file browser-compilable:
 *  - relative `@import './x.css'` files are inlined (the browser compiler
 *    can't read the filesystem),
 *  - `@source` directives are stripped (the browser scans the DOM instead),
 *  - external `@import url(...)` lines (fonts) are hoisted into a plain
 *    <style> tag — the Tailwind browser build silently fails to compile a
 *    block that contains one.
 */
class PlatformRuntimeCss
{
    /**
     * Matches a whole @import statement, including media/layer conditions.
     */
    protected const IMPORT_PATTERN = '/@import\s+(?:url\(\s*(?:"[^"]*"|\'[^\']*\'|[^)]*)\s*\)|"[^"]*"|\'[^\']*\')[^;{]*;/';

    /**
     * The <style> tags for the runtime head: external imports first (plain
     * CSS, loaded by the browser itself), then the Tailwind source block.
     */
    public static function styleTags(): string
    {
        $css = static::compile(resource_path('css/app.css'));

        [$external, $css] = static::splitExternalImports($css);

        // A literal </style> in the CSS would end the tag early.
        $css = str_ireplace('</style', '<\/style', $css);

        $tags = '';

        if ($external !== '') {
            $tags .= "<style>\n{$external}\n</style>\n";
        }

        return $tags."<style type=\"text/tailwindcss\">\n{$css}\n</style>";
    }

    /**
     * Read a CSS file, inline its relative imports (recursively), and strip
     * `@source` directives.
     */
    protected static function compile(string $path, int $depth = 0): string
    {
        if ($depth > 3 || ! is_file($path)) {
            return '';
        }

        $css = (string) file_get_contents($path);
        $dir = dirname($path);

        // @source lines reference build-time filesystem paths; the browser
        // compiler scans the rendered DOM instead.
        $css = (string) preg_replace('/^[ \t]*@source\b[^;]*;[ \t]*\r?\n?/m', '', $css);

        return (string) preg_replace_callback(self::IMPORT_PATTERN, function (array $match) use ($dir, $depth): string {
            preg_match('/(["\'])(.*?)\1|url\(\s*([^)"\']+?)\s*\)/', $match[0], $target);
            $import = trim($target[2] ?? '') !== '' ? trim($target[2]) : trim($target[3] ?? '');

            // Only relative file imports are inlined; "tailwindcss" and
            // friends are resolved by the browser build, and external URLs
            // are handled by splitExternalImports().
            if (! str_starts_with($import, './') && ! str_starts_with($import, '../')) {
                return $match[0];
            }

            $file = $dir.'/'.ltrim($import, './');

            if (! str_ends_with($file, '.css')) {
                $file .= '.css';
            }

            return static::compile($file, $depth + 1);
        }, $css);
    }

    /**
     * Pull external @import statements (Google Fonts and friends) out of the
     * Tailwind block. Same behavior as the Designer's composer.
     *
     * @return array{0: string, 1: string} [external import statements, remaining css]
     */
    protected static function splitExternalImports(string $css): array
    {
        $imports = [];

        $remaining = preg_replace_callback(self::IMPORT_PATTERN, function (array $match) use (&$imports): string {
            preg_match('/(["\'])(.*?)\1|url\(\s*([^)"\']+?)\s*\)/', $match[0], $target);
            $url = trim($target[2] ?? '') !== '' ? trim($target[2]) : trim($target[3] ?? '');

            if (! preg_match('#^(?:https?:)?//#i', $url)) {
                return $match[0];
            }

            $imports[] = trim($match[0]);

            return '';
        }, $css);

        return [implode("\n", $imports), trim((string) $remaining)];
    }
}

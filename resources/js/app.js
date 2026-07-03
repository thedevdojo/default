/**
 * DevDojo Bridge — app side.
 *
 * When this app renders inside the platform builder's canvas iframe, it
 * announces itself to the builder and accepts a small set of remote
 * commands (navigate, reload, theme). Every message is origin-checked
 * against the configured builder URL and wrapped in a versioned envelope,
 * so a page from anywhere else can neither listen in nor drive the app.
 */
const BRIDGE_SOURCE = 'devdojo-bridge';
const BRIDGE_VERSION = 1;

function builderOrigin() {
    const meta = document.querySelector('meta[name="platform-builder-url"]');

    if (! meta || ! meta.content) {
        return null;
    }

    try {
        return new URL(meta.content).origin;
    } catch {
        return null;
    }
}

function startBridge() {
    if (window.self === window.top) {
        return;
    }

    const origin = builderOrigin();

    if (! origin) {
        return;
    }

    const send = (type, payload = {}) => {
        window.parent.postMessage({ source: BRIDGE_SOURCE, v: BRIDGE_VERSION, type, payload }, origin);
    };

    const state = () => ({
        path: window.location.pathname + window.location.search,
        title: document.title,
        theme: document.documentElement.classList.contains('dark') ? 'dark' : 'light',
    });

    window.addEventListener('message', (event) => {
        if (event.origin !== origin) {
            return;
        }

        const message = event.data;

        if (! message || message.source !== BRIDGE_SOURCE) {
            return;
        }

        switch (message.type) {
            case 'hello':
                send('ready', state());
                break;

            case 'navigate': {
                const path = message.payload?.path;

                if (typeof path === 'string' && path.startsWith('/') && ! path.startsWith('//')) {
                    window.location.assign(path);
                }
                break;
            }

            case 'reload':
                window.location.reload();
                break;

            case 'theme': {
                const dark = message.payload?.mode === 'dark';
                document.documentElement.classList.toggle('dark', dark);
                document.documentElement.style.colorScheme = dark ? 'dark' : 'light';

                try {
                    localStorage.setItem('theme', dark ? 'dark' : 'light');
                } catch {}

                send('state', state());
                break;
            }
        }
    });

    send('ready', state());
    document.addEventListener('livewire:navigated', () => send('state', state()));
}

startBridge();

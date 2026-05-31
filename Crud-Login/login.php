<!DOCTYPE html>
<html class="light" lang="pt-br">

<head>
    <meta charset="utf-8" />
    <meta content="width=device-width, initial-scale=1.0" name="viewport" />
    <title>Tech Solutions - Login</title>
    <script src="https://cdn.tailwindcss.com?plugins=forms,container-queries"></script>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800;900&display=swap" rel="stylesheet" />
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:wght,FILL@100..700,0..1&display=swap" rel="stylesheet" />
    <script id="tailwind-config">
        tailwind.config = {
            darkMode: "class",
            theme: {
                extend: {
                    "colors": {
                        "background": "#f6faff",
                        "tertiary-fixed-dim": "#f7b993",
                        "secondary-fixed-dim": "#edc14a",
                        "inverse-surface": "#293138",
                        "on-primary": "#ffffff",
                        "primary-container": "#171a4a",
                        "on-secondary-container": "#745a00",
                        "secondary-fixed": "#ffdf93",
                        "error": "#ba1a1a",
                        "on-primary-fixed": "#131546",
                        "on-surface-variant": "#46464f",
                        "on-secondary-fixed-variant": "#594400",
                        "primary-fixed": "#e0e0ff",
                        "surface": "#f6faff",
                        "error-container": "#ffdad6",
                        "surface-bright": "#f6faff",
                        "on-tertiary-fixed": "#311300",
                        "surface-container-lowest": "#ffffff",
                        "surface-container-high": "#e0e9f2",
                        "on-primary-fixed-variant": "#3f4274",
                        "secondary-container": "#ffd259",
                        "tertiary-container": "#381600",
                        "on-surface": "#141d23",
                        "inverse-on-surface": "#e9f2fb",
                        "surface-tint": "#575a8d",
                        "inverse-primary": "#bfc2fc",
                        "on-primary-container": "#8083b9",
                        "primary": "#000032",
                        "outline": "#777680",
                        "surface-variant": "#dbe4ed",
                        "on-secondary": "#ffffff",
                        "on-error-container": "#93000a",
                        "primary-fixed-dim": "#bfc2fc",
                        "secondary": "#765b00",
                        "outline-variant": "#c7c5d0",
                        "on-tertiary-fixed-variant": "#673c1f",
                        "surface-container": "#e6eff8",
                        "surface-container-low": "#ecf5fe",
                        "on-tertiary": "#ffffff",
                        "on-secondary-fixed": "#241a00",
                        "tertiary": "#120400",
                        "on-tertiary-container": "#b17b59",
                        "on-error": "#ffffff",
                        "tertiary-fixed": "#ffdbc7",
                        "on-background": "#141d23",
                        "surface-dim": "#d2dbe4",
                        "surface-container-highest": "#dbe4ed"
                    },
                    "fontFamily": {
                        "display-lg": ["Inter"],
                        "headline-lg-mobile": ["Inter"],
                        "headline-sm": ["Inter"],
                        "label-sm": ["Inter"],
                        "label-md": ["Inter"],
                        "body-sm": ["Inter"],
                        "headline-lg": ["Inter"],
                        "body-lg": ["Inter"],
                        "body-md": ["Inter"],
                        "headline-md": ["Inter"]
                    }
                },
            },
        }
    </script>
    <style>
        .material-symbols-outlined {
            font-variation-settings: 'FILL' 0, 'wght' 400, 'GRAD' 0, 'opsz' 24;
        }

        .input-focus-ring:focus {
            outline: none;
            border-color: #171a4a;
            box-shadow: 0 0 0 4px rgba(219, 177, 59, 0.2);
        }

        .glass-effect {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(10px);
        }
    </style>
</head>

<body class="bg-primary-container min-h-screen flex items-center justify-center font-body-md text-on-background relative overflow-hidden">
    <div class="absolute inset-0 z-0 opacity-20 pointer-events-none">
        <div class="absolute top-[-10%] left-[-10%] w-[50%] h-[50%] bg-secondary-container rounded-full blur-[120px]"></div>
        <div class="absolute bottom-[-10%] right-[-10%] w-[40%] h-[40%] bg-surface-tint rounded-full blur-[100px]"></div>
    </div>
    <main class="relative z-10 w-full max-w-[440px] px-6 py-12">
        <div class="glass-effect rounded-xl shadow-[0_16px_32px_rgba(23,26,74,0.15)] overflow-hidden border border-white/20">
            <div class="p-8 md:p-10 flex flex-col items-center">
                <div class="mb-8 flex flex-col items-center">
                    <div class="w-16 h-16 bg-primary-container rounded-xl flex items-center justify-center mb-4 shadow-md">
                        <span class="material-symbols-outlined text-secondary-container text-4xl" style="font-variation-settings:'FILL' 1;">domain</span>
                    </div>
                    <h1 class="font-headline-lg text-3xl font-bold text-primary tracking-tight mb-2">Tech Solutions</h1>
                    <p class="font-body-sm text-body-sm text-on-surface-variant text-center">Insira as suas credenciais para aceder ao sistema</p>
                </div>
                
                <form class="w-full space-y-6" method="POST" action="validar.php">
                    <div class="space-y-2">
                        <label class="font-label-md text-sm font-semibold text-on-surface-variant block ml-1" for="email">Endereço de E-mail</label>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant transition-colors group-focus-within:text-primary">mail</span>
                            <input class="w-full pl-12 pr-4 py-3.5 bg-surface-container-lowest border border-outline-variant/30 rounded-lg font-body-md text-on-surface input-focus-ring transition-all" id="email" placeholder="nome@empresa.com" required="" type="email" name="email" />
                        </div>
                    </div>
                    <div class="space-y-2">
                        <div class="flex justify-between items-center px-1">
                            <label class="font-label-md text-sm font-semibold text-on-surface-variant" for="password">Palavra-passe</label>
                            <a class="text-xs text-secondary hover:underline transition-all" href="#">Esqueceu-se?</a>
                        </div>
                        <div class="relative group">
                            <span class="material-symbols-outlined absolute left-4 top-1/2 -translate-y-1/2 text-outline-variant transition-colors group-focus-within:text-primary">lock</span>
                            <input class="w-full pl-12 pr-12 py-3.5 bg-surface-container-lowest border border-outline-variant/30 rounded-lg font-body-md text-on-surface input-focus-ring transition-all" id="password" placeholder="••••••••" name="senha" required="" type="password" />
                            <button class="absolute right-4 top-1/2 -translate-y-1/2 text-outline-variant hover:text-primary transition-colors" type="button">
                                <span class="material-symbols-outlined">visibility</span>
                            </button>
                        </div>
                    </div>
                    <div class="flex items-center space-x-2 px-1">
                        <input class="w-4 h-4 rounded border-outline-variant text-secondary focus:ring-secondary/20 cursor-pointer" id="remember" type="checkbox" />
                        <label class="text-sm text-on-surface-variant cursor-pointer select-none" for="remember">Lembrar este dispositivo</label>
                    </div>
                    <div class="pt-2">
                        <button class="w-full bg-secondary-container text-on-secondary-container font-semibold py-4 rounded-lg shadow-sm hover:shadow-md active:scale-[0.98] transition-all duration-200 border border-secondary/20" type="submit">
                            Entrar
                        </button>
                    </div>
                </form>

                <div class="mt-8 pt-8 border-t border-surface-variant w-full flex flex-col items-center gap-4">
                    <p class="text-xs text-on-surface-variant uppercase tracking-widest">Ou autentique-se via</p>
                    <div class="flex gap-4 w-full">
                        <button class="flex-1 flex justify-center items-center py-3 bg-white border border-outline-variant/20 rounded-lg hover:bg-surface-container transition-colors shadow-sm active:opacity-80">
                            <span class="material-symbols-outlined mr-2 text-red-600">g_mobiledata</span>
                            <span class="text-sm font-medium text-on-surface">Google</span>
                        </button>
                        <button class="flex-1 flex justify-center items-center py-3 bg-[#1877F2] text-white border-none rounded-lg hover:opacity-90 transition-opacity shadow-sm active:opacity-80">
                            <span class="material-symbols-outlined mr-2" data-weight="fill">shield_person</span>
                            <span class="text-sm font-medium">SSO</span>
                        </button>
                    </div>
                </div>
            </div>
            
            <div class="bg-surface-container py-4 px-8 flex justify-center border-t border-surface-variant/50">
                <p class="text-xs text-on-surface-variant text-center">
                    © 2026 Tech Solutions Enterprise. Todos os direitos reservados.
                </p>
            </div>
        </div>
        
        <div class="mt-8 flex justify-center gap-6">
            <a class="text-xs text-on-primary/60 hover:text-on-primary transition-colors" href="#">Política de Privacidade</a>
            <a class="text-xs text-on-primary/60 hover:text-on-primary transition-colors" href="#">Termos de Serviço</a>
            <a class="text-xs text-on-primary/60 hover:text-on-primary transition-colors" href="#">Ajuda</a>
        </div>
    </main>

    <div class="fixed bottom-0 right-0 p-8 hidden lg:block opacity-40">
        <div class="text-right">
            <p class="font-display-lg text-4xl font-bold text-white/10 select-none pointer-events-none">ACESSO SEGURO</p>
            <p class="text-xs font-semibold text-white/20 select-none pointer-events-none">VERSÃO 1.0.0-ESTÁVEL</p>
        </div>
    </div>
</body>

</html>
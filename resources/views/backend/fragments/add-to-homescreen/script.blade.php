<script>
    const button = document.getElementById("pwa");
    if ('serviceWorker' in navigator) {
        navigator.serviceWorker.register('{{asset("server.js")}}')
            .then(function (reg) {

            }).catch(function (err) {
            console.log("Failed to register worker:", err);
        });

        let deferredPrompt;
        const OS = getMobileOperatingSystem();
        const chromeVersion = getChromeVersion();

        if (OS === "Android" || OS === "Windows Phone") {
            window.addEventListener('beforeinstallprompt', (e) => {
                e.preventDefault();
                deferredPrompt = e;
                showInstallPromotion();
            });
        } else if (OS === "iOS") {
            const isInStandaloneMode = () => ('standalone' in window.navigator) && (window.navigator.standalone);
            if (button != null) {
                if (!isInStandaloneMode()) {
                    button.addEventListener('click', (e) => {
                        $('#iosModal').modal('show');
                    });
                }
            }
        } else {
            if (button != null) {
                button.addEventListener('click', (e) => {
                    $('#otherModal').modal('show');
                });
            }
        }


        function showInstallPromotion() {
            if (button != null) {
                button.addEventListener('click', (e) => {
                    deferredPrompt.prompt();
                    deferredPrompt.userChoice
                        .then((choiceResult) => {
                            if (choiceResult.outcome === 'accepted') {
                                console.log('User accepted the A2HS prompt');
                            } else {
                                console.log('User dismissed the A2HS prompt');
                            }
                            deferredPrompt = null;
                        });
                });
            }
        }

        function getChromeVersion() {
            const raw = navigator.userAgent.match(/Chrom(e|ium)\/([0-9]+)\./);
            return raw ? parseInt(raw[2], 10) : false;
        }

        /**
         * Determine the mobile operating system.
         * This function returns one of 'iOS', 'Android', 'Windows Phone', or 'unknown'.
         *
         * @returns {String}
         */
        function getMobileOperatingSystem() {
            const userAgent = navigator.userAgent || navigator.vendor || window.opera;

            // Windows Phone must come first because its UA also contains "Android"
            if (/windows phone/i.test(userAgent)) {
                return "Windows Phone";
            }

            if (/android/i.test(userAgent)) {
                return "Android";
            }

            // iOS detection from: http://stackoverflow.com/a/9039885/177710
            if (/iPad|iPhone|iPod/.test(userAgent) && !window.MSStream) {
                return "iOS";
            }

            return "unknown";
        }
    }
</script>
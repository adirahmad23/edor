<style>
    #kotak {
        text-align: center;
    }

    #webcam,
    #canvas {
        width: 100%;
        max-width: 250px;
        /* Sesuaikan ukuran maksimum sesuai kebutuhan */
        height: auto;
        margin: 0 auto;
    }

    #nameInput,
    #captureButton {
        width: 100%;
        margin-top: 10px;
        /* Sesuaikan margin sesuai kebutuhan */
    }

    @media (min-width: 576px) {
        #kotak {
            display: flex;
            flex-direction: column;
            align-items: center;
        }

        #webcam,
        #canvas,
        #nameInput,
        #captureButton {
            max-width: none;
            width: auto;
            margin: 0;
        }

        #nameInput,
        #captureButton {
            order: 1;
            /* Ganti urutan sesuai kebutuhan */
        }
    }
</style>
<script>
    document.addEventListener('DOMContentLoaded', function() {
        // Check if the page has been refreshed
        if (localStorage.getItem('pageRefreshed') !== 'true') {
            // Set a flag in localStorage to indicate that the page has been refreshed
            localStorage.setItem('pageRefreshed', 'true');
            // Perform the refresh
            location.reload();
        }
    });
</script>
<script type="text/javascript">
        var Tawk_API = Tawk_API || {}, Tawk_LoadStart = new Date();
        (function() {
            var s1 = document.createElement("script"), s0 = document.getElementsByTagName("script")[0];
            s1.async = true;
            s1.src = 'https://embed.tawk.to/66f10bda4cbc4814f7dd64e9/1i8epcji0'; // Ganti dengan ID widget Anda
            s1.charset = 'UTF-8';
            s1.setAttribute('crossorigin', '*');
            s0.parentNode.insertBefore(s1, s0);
        })();
    </script>
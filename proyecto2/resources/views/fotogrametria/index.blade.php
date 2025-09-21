<!DOCTYPE html>
<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Fotogrametría</title>
    </head>
    <body>
        
        <h1>Captura de fotograma (Fotogrametría)</h1>

        <video id="video" width="400" autoplay></video>
        <canvas id="canvas" width="400" height="300" style="display:none;"></canvas>
        <button id="capturar">Capturar y guardar</button>

        <h2>Últimos fotogramas guardados</h2>
        @foreach ($fotogramas as $foto)
            <img src="{{ $foto->imagen }}" width="200" style="margin:5px;">
        @endforeach

        <script>

            const video = document.getElementById('video');
            const canvas = document.getElementById('canvas');
            const capturar = document.getElementById('capturar');
            const ctx = canvas.getContext('2d');

            //Encender camara
            navigator.mediaDevices.getUserMedia({ video:true }).then(stream => {
                video.srcObject = stream;
                //Apagar camara despues de 10 segundos
                setTimeout(() => {
                    stream.getTracks().forEach(track => track.stop());
                }, 10000);
            }).catch(err => console.error("Error: ", err));

            //Capturar y enviar fotograma
            capturar.addEventListener("click", () => {
                ctx.drawImage(video, 0, 0, canvas.width, canvas.height);
                const dataURL = canvas.toDataURL("image/png"); //Base 64
                fetch("{{ route('fotogrametria.store') }}", {
                    method: "POST",
                    headers: {
                        "Content-Type": "application/json",
                        "X-CSRF-TOKEN": "{{ csrf_token() }}"
                    }, body: JSON.stringify({ imagen: dataURL })
                })
                .then(res => res.json())
                .then(data => alert(data.message))
                .catch(err => console.error(err));
            })

        </script>
    </body>
</html>
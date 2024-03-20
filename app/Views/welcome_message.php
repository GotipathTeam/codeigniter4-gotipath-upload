<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>Welcome to CodeIgniter 4!</title>
    <meta name="description" content="The small framework with powerful features">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="shortcut icon" type="image/png" href="/favicon.ico">

    <!-- STYLES -->
    <style>
        .uppy-Dashboard-poweredBy {
            display: none !important;
        }
    </style>
</head>

<body>
    <div class="uppy-dashboard"></div>
    <script src="/dist/app.js"></script>
    <script>
        let videoId = "b952371d-7632-4789-92d6-6e2315017d12";
        const LibraryId = "c94deedf-edbc-49aa-8805-8f199c017ff";
        const ClientId = "92f9d000-5051-4339-9b3a-91f1c2a4c07";
        const ApiKey = "y/r2DtLbfjeyrwu4cyZKeJTA/AT1OiuN0v5W+6Ne6jP229LnLVtgAW4OszQgJw5hlU76S";

        // AUTH HEADERS
        const headers = {
            "X-Auth-ClientId": ClientId,
            "X-Auth-LibraryId": LibraryId,
            "X-Auth-ApiKey": ApiKey,
        };

        // // create video  & get video id
        // const createVideo = async () => {
        //     const response = await fetch(`https://apistream.gotipath.com/v1/libraries/${LibraryId}/videos`, {
        //         method: "POST",
        //         headers: {
        //             "Content-Type": "application/json",
        //             ...headers,
        //         },
        //         body: JSON.stringify({
        //             name: "Test Video",
        //             description: "Test Video Description"
        //         }),
        //     });
        //     const data = await response.json();
        //     return data.id;
        // };

        // createVideo().then((id) => {
        //     videoId = id;
        // });


        const uppy = new Uppy({
            debug: false,
            autoProceed: false,
            allowMultipleUploads: false,
            allowMultipleUploadBatches: true,
            proudlyDisplayPoweredByUppy: false,
        }).use(Dashboard, {
            inline: true,
            target: 'body'
        });
        uppy.use(AwsS3, {
            shouldUseMultipart: true,
            companionUrl: "https://apistream.gotipath.com/v1/uploads/",
            companionHeaders: {
                "uppy-auth-token": JSON.stringify(headers),
            },
        });

        uppy.on("file-added", (file) => {
            uppy.setFileMeta(file.id, {
                video_id: videoId,
                library_id: LibraryId,
                collection_id: "",
            });
        });
    </script>
</body>

</html>

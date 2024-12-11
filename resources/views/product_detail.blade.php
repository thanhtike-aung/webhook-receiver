<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css"
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <link href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css" rel="stylesheet">

    <title>Ordered Item</title>
</head>

<body>
    <div id="product-container" class="container mt-5">
        <div class="row">
            <div class="col-md-6">
                <img src="" id="product-img" class="img-fluid" style="width: 333px">
            </div>
            <div class="col-md-6">
                <h1 id="product-title"></h1>
                <p id="product-category" class="text-muted"></p>
                <div class="d-flex justify-content-between mt-3">
                    <span id="product-price" class="fs-4 font-weight-bold"></span>
                    <div class="d-flex align-items-center">
                        <span id="product-rate" class="text-warning mr-2"><i class="fas fa-star"></i></span>
                        &nbsp;
                        <span id="product-rate-count" class="text-muted"></span>
                    </div>
                </div>
                <p id="product-desc" class="mt-4"></p>
            </div>
        </div>
    </div>
    <div id="no-product-container" class="mt-5">
        <figure class="text-center">
            <blockquote class="blockquote">
                <p>Your ordered item will appear here</p>
            </blockquote>
            <figcaption class="blockquote-footer">
                via webhook
            </figcaption>
        </figure>
    </div>
</body>
<script src="https://code.jquery.com/jquery-3.6.4.min.js"></script>
<script src="https://js.pusher.com/8.2.0/pusher.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.js"></script>

<script>
    const productContainer = $("#product-container");
    const noProductContainer = $("#no-product-container");
    const image = $('#product-img');
    const title = $('#product-title');
    const category = $('#product-category');
    const price = $('#product-price');
    const desc = $('#product-desc');
    const rate = $('#product-rate');
    const rateCount = $('#product-rate-count');

    Pusher.logToConsole = true;
    productContainer.hide();

    const pusher = new Pusher('8eb928d262d185bf37e9', {
        cluster: 'ap1'
    });
    const channel = pusher.subscribe('zmt-channel');

    channel.bind('App\\Events\\WebhookEvent', function(data) {
        if (data) {
            toastr.options.progressBar = true;
            toastr.info("order received from webhook!");
            productContainer.show();
            noProductContainer.hide();

            const product = data.product.product_data;
            image.attr("src", product.image);
            title.text(product.title);
            category.text(product.category);
            price.text(`$${product.price}`);
            desc.text(product.description);
            rate.text(product.rating.rate);
            rateCount.text(`(${product.rating.count} reviews)`);
        }
    });
</script>

</html>

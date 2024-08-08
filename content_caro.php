<div id="carouselExampleCaptions" class="carousel slide col-md-12 col-sm-12 col-12" data-bs-ride="carousel">

    <div class="carousel-indicators">
        <?php
        $query_carousel_online = "SELECT * FROM carousel WHERE caro_online=1 ORDER BY caro_sort";
        $carousel_online = $link->query($query_carousel_online);
        ?>
        <?php
        $i = 0;
        for ($i = 0; $i < $carousel_online->rowCount(); $i++) { ?>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $i ?>" class="<?php echo activeShow($i, 0) ?>" aria-current="true" aria-label="Slide <?php echo $i ?>"></button>
        <?php } ?>
    </div>

    <div class="carousel-inner img-fluid">

        <?php
        // function activeShow($num, $cheak_num)
        // {
        //     return (($num == $cheak_num) ? "active" : "");
        // }
        ?>
        <?php
        $i = 0;
        while ($carousel_result_online = $carousel_online->fetch()) {
        ?>
            <div class="carousel-item <?php echo activeShow($i, 0) ?>">
                <img src="./images/carousels/<?php echo $carousel_result_online['caro_pic'] ?>" class="d-block w-100" alt="<?php echo $carousel_result_online["caro_title"] ?>">

                <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo $carousel_result_online["caro_title"] ?></h5>
                    <p><?php echo $carousel_result_online["caro_content"] ?></p>
                </div>
            </div>
        <?php $i++;
        } ?>
    </div>

    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
        <span class="carousel-control-next-icon" aria-hidden="true"></span>
        <span class="visually-hidden">Next</span>
    </button>
</div>
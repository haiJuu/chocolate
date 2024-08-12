<div id="carouselExampleCaptions" class="carousel slide col-md-12 col-sm-12 col-12" data-bs-ride="carousel">

    <div class="carousel-indicators">
        <?php
        $select_carousel = "SELECT * FROM carousel WHERE caro_online=1 ORDER BY caro_sort";
        $carousel = $link->query($select_carousel);
        ?>
        <?php
        $now_carousel = 0;

        for ($now_carousel = 0; $now_carousel < $carousel->rowCount(); $now_carousel++) { ?>
            <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="<?php echo $now_carousel ?>" class="<?php echo classActive($now_carousel, 0) ?>" aria-current="true" aria-label="Slide <?php echo $now_carousel ?>"></button>
        <?php } ?>
    </div>

    <div class="carousel-inner img-fluid">
        <?php
        $now_carousel = 0;
        while ($fetch_carousel = $carousel->fetch()) {
        ?>

            <div class="carousel-item <?php echo classActive($now_carousel, 0) ?>">
                <a href="<?php echo carouselsHref($fetch_carousel) ?>"><img src="./images/carousels/<?php echo $fetch_carousel['caro_pic'] ?>" class="d-block w-100" alt="<?php echo $fetch_carousel["caro_title"] ?>"></a>

                <div class="carousel-caption d-none d-md-block">
                    <h5><?php echo $fetch_carousel["caro_title"] ?></h5>
                    <p><?php echo $fetch_carousel["caro_content"] ?></p>
                </div>
            </div>
        <?php $now_carousel++;
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
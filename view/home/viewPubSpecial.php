<div class="card" >
            <main class="seccion_caja">  
                <h3>Publicaciones Especiales</h3><br>
                <section >   
                    <?php if(count($dataToView["data"])>0){ ?>
                        <?php foreach (array_reverse($dataToView["data"]) as $data) { ?>
                            <div class="platillas">
                                <article >
                                    <div >
                                        <div class="imgsabrina" >
                                            <img src="<?php echo $data['image']; ?>" alt="Imagen publicación especial" width=150px height= 100px>
                                        </div>
                                        <div class="card-data">
                                            <p class="title"><?php echo $data['title']; ?></p>
                                            <p><?php echo $data['description']; ?></p>
                                        </div>
                                    </div>
                                </article>
                            </div>
                        <?php } ?>
                    <?php } else { ?>
                        <div>
                            Actualmente No Hay Publicaciones Especiales Disponibles.
                        </div>
                    <?php } ?>
                </section>
            </main>
        </div>
    </div>
</section>
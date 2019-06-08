<div class="output">
                <section class="output">
                    <h3>Resultado</h3>
                    <?php
                        $finalRequest = '';
                        foreach (getImageKeys() as $key => $value) {
                            $finalRequest .= '&' . $key . '=' . urlencode($value);
                        }
                        if (strlen($finalRequest) > 0) {
                            $finalRequest[0] = '?';
                        }
                    ?>
                    <div id="imageOutput">
                        <?php if ($imageKeys['text'] !== '') { ?><img src="image.php<?php echo $finalRequest; ?>" alt="Código de Barras" />
                        <input type="hidden" value="image.php<?php echo $finalRequest; ?>" id="codS"><?php }
                        else { ?>Aquí se generará el código de barras.
                        <input type="hidden" value="javascript:;" id="codS"><?php } ?>
                    </div>
                </section>
            </div>
        </form>
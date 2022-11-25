<?php

                                // $service_providers = '';
                                
                                // $query_city = ($_GET['city']) ? $_GET['city'] : '';
                                // $query_keyword = ($_GET['keyword']) ? $_GET['keyword'] : '';
                                // $query_price = ($_GET['pricerange']) ? $_GET['pricerange'] : '';

                                // if(isset($_GET['city']) || isset($_GET['keyword']) || isset($_GET['pricerange'])){

                                //     // $query_city = $_GET['city'];
                                //     // $query_keyword = $_GET['keyword'];
                                //     // $query_price = $_GET['pricerange'];

                                

                                $service_providers_args = array(
                                    'posts_per_page' => -1,
                                    'post_type' => 'service-provider',
                                );

                                if(isset($_GET['keyword']) && !empty($_GET['keyword'])){
                                    $service_providers_args['s'] = $_GET['keyword'];
                                };

                                if(isset($_GET['city']) && !empty($_GET['city'])){

                                    $service_providers_args['tax_query'] = array(
                                        array (
                                            'taxonomy' => 'city',
                                            'field' => 'term_id',
                                            'terms' => $_GET['city'],
                                        )
                                    );

                                };

                                if(isset($_GET['pricerange']) && !empty($_GET['pricerange'])){

                                    $range_val = explode(',', $_GET['pricerange']);

                                    $service_providers_args['meta_query'] = array(
                                        'relation'      => 'AND',
                                        array(
                                            'key' => 'price',
                                            'value' => array((int) $range_val[0], (int) $range_val[1]),
                                            'compare' => 'BETWEEN',
                                            'type' => 'NUMERIC'
                                        )
                                    );

                                };

                                print_r($service_providers_args);


                                $service_providers = new WP_Query( $service_providers_args );


                                // } else {

                                //     $service_providers = new WP_Query( array(
                                //         'posts_per_page' => -1,
                                //         'post_type' => 'service-provider',
                                //     ) );

                                // }

                                // echo "<pre>";
                                // print_r($service_providers);
                                // echo "</pre>";

                                $posttID = get_the_ID();

                                $count = $service_providers->found_posts;

                                if($count){

                                    while ( $service_providers->have_posts() ) :

                                        $service_providers->the_post();

                                        $providerID = get_the_ID();

                                        $featured_posts = get_field('service_type',$providerID);
                                            
                                        $pp = in_array($posttID, $featured_posts);
                                        
                                        if($pp) {
                                            
                                            $img_url = wp_get_attachment_url( get_post_thumbnail_id($providerID), 'full' );
                                            
                                            ?>
                                            
                                            <li class="fk_li">
                                                <a href="<?php echo get_permalink( $providerID )?>">
                                                    <div><img src="<?php echo ($img_url) ? $img_url : 'https://www.monazim.com/wp-content/uploads/2020/12/no-image-available_1.png' ; ?>" /></div>
                                                    <div><h5><?php print_r(get_the_title($providerID)); ?></h5></div>
                                                </a>
                                            </li>
                                            
                                            <?php
                                            
                                        } else {

                                            ?>

                                            <!--<li class="notmzfound mz_emp">Sorry, no providers found.</li>-->

                                            <?php

                                        }

                                    endwhile;

                                    wp_reset_postdata();

                                } else {

                                        ?>

                                        <li class="notmzfound">Sorry, no providers found.</li>

                                        <?php
                                }
                                
                                ?>
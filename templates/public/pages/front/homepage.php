<?php
get_header();

?>

<div class="homepage row no-margin-bottom">

    <section id="opener" class="profenda-section padding-top-50 padding-bottom-50 relative">

        <svg class="curved-divider curved-bottom-left" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="590 165.4 1599 265.9" xml:space="preserve" style="position: absolute;top: -100px;z-index: 0;width: 100%;left: 0;">
            <g id="Design-1">
                <g id="landing-page-1" transform="translate(-1.000000, -660.000000)">
                    <g id="Group-19" transform="translate(1.000000, 660.000000)">
                        <path id="Rectangle_3_" fill="#075BC1" d="M2189.1,165.4l0,225.9c-202.1-53.3-468.6-53.3-799.6,0c-330.9,53.3-597.5,53.3-799.6,0V165.4L2189.1,165.4z" style="fill: #bfd8fa;"></path>
                    </g>
                </g>
            </g>
        </svg>

        <div class="container relative z-index-1">

            <div class="flex flex-center full-width">

                <div class="col l6 m6 s12">

                    <h1 style="font-size:2.6rem;">
                        A Platform for Scheduling Appointments Online in the Shipping Industry.
                    </h1>

                    <p style="color:#222;">
                        Profenda is an online appointment scheduling platform that connects Shipping Companies with Suppliers.
                        It's a professional agenda which simplifies how you schedule and run customer meetings.
                        Let your clients choose how, when and where to meet you in just a few clicks.
                    </p>

                    <button class="saveAvailability save-button">GET STARTED</button>

                </div>


                <div class="col l6 m6 s12">

                    <div class="illustration">
                        <?php echo wp_get_attachment_image( 377, 'full'); ?>
                    </div>

                </div>

            </div>

        </div>

    </section>

    <section id="whyProfenda" class="profenda-section padding-top-50 padding-bottom-50 relative" style="background-color: #bfd8fa;">

        <div class="container">

            <div class="flex full-width">

                <div class="col l4 m6 s12">

                    <div class="card">

                        <div class="card-image">
                            <?php echo wp_get_attachment_image( 261, 'full'); ?>
                        </div>

                        <div class="card-content">

                            <h3>
                                Connect
                            </h3>

                            <p>
                                Bridge the gap between your staff and customers with our intuitive Virtual Meeting engine.
                            </p>

                        </div>

                    </div>

                </div>
                <div class="col l4 m6 s12">

                    <div class="card">

                        <div class="card-image">
                            <?php echo wp_get_attachment_image( 263, 'full'); ?>
                        </div>

                        <div class="card-content">

                            <h3>
                                Control
                            </h3>

                            <p>
                                Manage and control scheduling rules across every level of your organisation with ease.
                            </p>

                        </div>

                    </div>

                </div>
                <div class="col l4 m6 s12">

                    <div class="card">

                        <div class="card-image">
                            <?php echo wp_get_attachment_image( 262, 'full'); ?>
                        </div>

                        <div class="card-content">
                            <h3>
                                Discover
                            </h3>

                            <p>
                                Gain actionable insights into your appointment performance to make informed future decisions.
                            </p>
                        </div>

                    </div>

                </div>

            </div>

        </div>

    </section>

</div>

<?php

get_footer();

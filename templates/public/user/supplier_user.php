<?php
get_header();

$platformUser = new \ShippingAppointments\Service\Entities\User\PlatformUser( get_queried_object_id() );

function weekdaysDisalable($weekDays) {

    $weekDaysReturnArray = array();

    if (!stristr($weekDays, "mon")) {
        array_push($weekDaysReturnArray, "1");
    }
    if (!stristr($weekDays, "tue")) {
        array_push($weekDaysReturnArray, "2");
    }
    if (!stristr($weekDays, "wed")) {
        array_push($weekDaysReturnArray, "3");
    }
    if (!stristr($weekDays, "thu")) {
        array_push($weekDaysReturnArray, "4");
    }
    if (!stristr($weekDays, "fri")) {
        array_push($weekDaysReturnArray, "5");
    }
    if (!stristr($weekDays, "sat")) {
        array_push($weekDaysReturnArray, "6");
    }
    if (!stristr($weekDays, "sun")) {
        array_push($weekDaysReturnArray, "0");
    }

    $weekDaysReturn = implode(",", $weekDaysReturnArray);
    echo $weekDaysReturn;
}


?>

    <section class="dashboard-template-opener full-width padding-top-30 padding-bottom-30">

        <div class="container relative z-index-1">

            <div class="col s12">

                <div class="flex flex-center full-width">

                    <div class="dashboard-template-opener-image display-inline-block">
	                    <?php echo get_avatar( $platformUser->ID ); ?>
                    </div>

                    <div class="dashboard-template-opener-title display-inline-block">

                        <h1>
							<?php echo $platformUser->first_name . " " . $platformUser->last_name; ?>
                        </h1>

                        <p>
							<?php echo get_user_meta($platformUser->ID, 'description', true); ?>
                        </p>

                    </div>

                </div>

            </div>

        </div>

    </section>

    <section class="user-content full-width padding-top-50 padding-bottom-50">

        <div class="container">

            <div class="company-stats flex full-width">

                <div class="col xl3 l6 m6 s12">
                    <div class="company-stats-item flex flex-center flex-dir-col center">

                        <div class="icon">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M256,0C156.748,0,76,80.748,76,180c0,33.534,9.289,66.26,26.869,94.652l142.885,230.257c2.737,4.411,7.559,7.091,12.745,7.091c0.04,0,0.079,0,0.119,0c5.231-0.041,10.063-2.804,12.75-7.292L410.611,272.22C427.221,244.428,436,212.539,436,180C436,80.748,355.252,0,256,0z M384.866,256.818L258.272,468.186l-129.905-209.34C113.734,235.214,105.8,207.95,105.8,180c0-82.71,67.49-150.2,150.2-150.2S406.1,97.29,406.1,180C406.1,207.121,398.689,233.688,384.866,256.818z"/></g></g><g><g><path d="M256,90c-49.626,0-90,40.374-90,90c0,49.309,39.717,90,90,90c50.903,0,90-41.233,90-90C346,130.374,305.626,90,256,90z M256,240.2c-33.257,0-60.2-27.033-60.2-60.2c0-33.084,27.116-60.2,60.2-60.2s60.1,27.116,60.1,60.2C316.1,212.683,289.784,240.2,256,240.2z"/></g></g></svg>
                        </div>

                        <div class="info">

                            <div class="info--label">
                                Location
                            </div>

                            <div class="info--value">
						        <?php echo $platformUser->getCountryDisplayName(); ?>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="col xl3  l6 m6 s12">
                    <div class="company-stats-item flex flex-center flex-dir-col center">

                        <div class="icon">
                            <svg height="457.66212pt" viewBox="0 0 457.66212 457.66212" width="457.66212pt" xmlns="http://www.w3.org/2000/svg"><path d="m334.792969 240.109375c-52.292969 0-94.6875 42.390625-94.6875 94.683594s42.394531 94.6875 94.6875 94.6875 94.6875-42.394531 94.6875-94.6875c-.0625-52.269531-42.417969-94.625-94.6875-94.683594zm0 173.371094c-43.457031 0-78.6875-35.230469-78.6875-78.6875s35.230469-78.6875 78.6875-78.6875 78.6875 35.230469 78.6875 78.6875c-.050781 43.4375-35.25 78.636719-78.6875 78.6875zm0 0"/><path d="m368.53125 333.832031h-30.699219v-42.410156c0-4.421875-3.582031-8-8-8s-8 3.578125-8 8v50.597656c.039063 2.117188.921875 4.132813 2.449219 5.597657 1.527344 1.46875 3.578125 2.265624 5.695312 2.214843h38.554688c4.421875 0 8-3.582031 8-8s-3.578125-8-8-8zm0 0"/><path d="m401.140625 231.417969c1.457031-9.851563 2.1875-19.792969 2.191406-29.753907 0-111.199218-90.46875-201.664062-201.667969-201.664062-111.195312 0-201.664062 90.46875-201.664062 201.664062 0 111.199219 90.46875 201.667969 201.664062 201.667969 9.960938 0 19.902344-.734375 29.753907-2.191406 27.125 42.292969 77.273437 63.804687 126.613281 54.308594 49.339844-9.496094 87.921875-48.078125 97.417969-97.417969 9.496093-49.339844-12.015625-99.488281-54.308594-126.613281zm-66.347656-19.5c-4.949219.027343-9.898438.355469-14.808594.976562.035156-1.046875.0625-2.066406.089844-3.066406h67.085937c-.191406 4-.554687 8.933594-1.070312 13.40625-16.078125-7.445313-33.578125-11.304687-51.296875-11.3125zm-278.5 105.1875c-24.339844-30.636719-38.378907-68.183594-40.109375-107.273438h67.0625c.515625 25.644531 4.675781 51.085938 12.359375 75.558594-14.386719 8.875-27.59375 19.53125-39.3125 31.714844zm39.3125-198.953125c-7.679688 24.515625-11.84375 49.996094-12.359375 75.679687h-67.0625c1.554687-39.164062 15.609375-76.800781 40.109375-107.398437 11.71875 12.183594 24.929687 22.839844 39.3125 31.71875zm251.460937-31.71875c24.484375 30.601562 38.527344 68.238281 40.082032 107.398437h-67.0625c-.511719-25.605469-4.652344-51.007812-12.300782-75.449219 14.398438-8.9375 27.597656-19.675781 39.28125-31.949218zm-42.984375 107.398437h-94.25v-45.839843c29.164063-1.023438 57.753907-8.398438 83.773438-21.609376 6.476562 21.917969 10 44.601563 10.476562 67.449219zm-94.25-61.851562v-113.414063c36 19.21875 62.800781 51.527344 78.59375 92.445313-24.285156 12.824219-51.152343 19.992187-78.59375 20.96875zm-16-.035157c-27.417969-1.101562-54.246093-8.320312-78.515625-21.132812 15.808594-40.828125 42.515625-73.058594 78.515625-92.246094zm0 16.011719v45.875h-94.585937c.539062-22.925781 4.140625-45.679687 10.710937-67.648437 26.023438 13.320312 54.660157 20.757812 83.875 21.773437zm-94.585937 61.875h94.585937v45.539063c-29.226562 1.082031-57.863281 8.574218-83.875 21.949218-6.574219-21.914062-10.171875-44.613281-10.710937-67.488281zm94.585937 61.546875v113.398438c-36-19.199219-62.714843-51.433594-78.519531-92.265625 24.265625-12.820313 51.097656-20.042969 78.519531-21.132813zm26.289063 107.316406c-3.371094 2.15625-7.289063 4.183594-10.289063 6.082032v-113.429688c6 .238282 12.578125.800782 18.855469 1.691406-18.707031 32.105469-21.855469 70.957032-8.566406 105.65625zm18.558594-120.253906c-9.523438-1.753906-19.167969-2.792968-28.847657-3.109375v-45.5h94.238281c-.058593 2-.089843 4.066407-.191406 6.125-25.761718 6.726563-48.640625 21.636719-65.199218 42.484375zm97.851562-184.246094c-10.210938 10.902344-21.722656 20.511719-34.269531 28.621094-13.414063-33.632812-34.007813-61.84375-60.582031-82.460937 36.296874 8.042969 69.339843 26.800781 94.851562 53.839843zm-174.875-53.839843c-26.527344 20.582031-47.09375 48.726562-60.511719 82.28125-12.542969-8.074219-24.066406-17.632813-34.316406-28.46875 25.511719-27.023438 58.542969-45.769531 94.828125-53.8125zm-94.828125 308.804687c10.25-10.835937 21.769531-20.394531 34.3125-28.46875 13.414063 33.550782 33.976563 61.699219 60.5 82.28125-36.277344-8.046875-69.304687-26.789062-94.8125-53.8125zm267.964844 112.5c-59.023438.003906-106.875-47.847656-106.871094-106.871094 0-59.027343 47.847656-106.875 106.875-106.875 59.023437.003907 106.871094 47.855469 106.867187 106.878907-.0625 58.996093-47.875 106.804687-106.871093 106.871093zm0 0"/></svg>
                        </div>

                        <div class="info">

                            <div class="info--label">
                                Timezone
                            </div>

                            <div class="info--value">
						        <?php echo $platformUser->getTimezoneDisplayName(); ?>
                            </div>

                        </div>

                    </div>
                </div>


                <div class="col xl3  l6 m6 s12">
                    <div class="company-stats-item flex flex-center flex-dir-col center">

                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="512" height="512"><g><path d="M437.02,74.98C388.667,26.629,324.38,0,256,0S123.333,26.629,74.98,74.98C26.629,123.333,0,187.62,0,256 s26.629,132.667,74.98,181.02C123.333,485.371,187.62,512,256,512s132.667-26.629,181.02-74.98C485.371,388.667,512,324.38,512,256 S485.371,123.333,437.02,74.98z M256,482C131.383,482,30,380.617,30,256S131.383,30,256,30s226,101.383,226,226 S380.617,482,256,482z"/><path d="M256,60C147.925,60,60,147.925,60,256s87.925,196,196,196s196-87.925,196-196S364.075,60,256,60z M256,422 c-91.533,0-166-74.467-166-166S164.467,90,256,90s166,74.467,166,166S347.533,422,256,422z"/><polygon points="271,241 271,120 241,120 241,271 392,271 392,241 "/><rect x="241" y="362" width="30" height="30"/><rect x="301.5" y="345.789" transform="matrix(-0.5 -0.866 0.866 -0.5 162.2998 815.2814)" width="30" height="30"/><rect x="345.789" y="301.5" transform="matrix(-0.866 -0.5 0.5 -0.866 514.9918 770.9913)" width="30" height="30"/><rect x="180.5" y="136.211" transform="matrix(-0.5 -0.866 0.866 -0.5 162.2973 396.1243)" width="30" height="30"/><rect x="136.211" y="180.5" transform="matrix(-0.866 -0.5 0.5 -0.866 184.4133 440.4134)" width="30" height="30"/><rect x="120" y="241" width="30" height="30"/><rect x="136.211" y="301.5" transform="matrix(-0.5 -0.866 0.866 -0.5 -47.2803 605.7025)" width="30" height="30"/><rect x="180.5" y="345.789" transform="matrix(-0.866 -0.5 0.5 -0.866 184.4136 770.9916)" width="30" height="30"/></g></svg>
                        </div>

                        <div class="info">

                            <div class="info--label">
                                Meeting Duration
                            </div>

                            <div class="info--value">
                                <?php echo $platformUser->meeting_duration;?> Min
                            </div>

                        </div>

                    </div>

                </div>

                <div class="col xl3  l6 m6 s12">
                    <div class="company-stats-item flex flex-center flex-dir-col center">

                        <div class="icon">
                            <svg xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Layer_1" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve" width="512" height="512"><g> <path d="M166,130c35.841,0,65-29.159,65-65S201.841,0,166,0s-65,29.159-65,65S130.159,130,166,130z M166,30 c19.299,0,35,15.701,35,35s-15.701,35-35,35s-35-15.701-35-35S146.701,30,166,30z"/> <path d="M31,235v90c0,24.813,20.187,45,45,45c5.257,0,10.306-0.906,15-2.57V512h150V160H106C64.646,160,31,193.645,31,235z M211,482h-30V325h-30v157h-30l0-156.878V229H91v96.071C90.962,333.309,84.248,340,76,340c-8.271,0-15-6.729-15-15v-90 c0-24.813,20.187-45,45-45h45v90h30v-90h30V482z"/> <path d="M346,130c35.841,0,65-29.159,65-65S381.841,0,346,0s-65,29.159-65,65S310.159,130,346,130z M346,30 c19.299,0,35,15.701,35,35s-15.701,35-35,35s-35-15.701-35-35S326.701,30,346,30z"/> <path d="M406,160H271l0,352h150V367.43c4.693,1.664,9.743,2.57,15,2.57c24.813,0,45-20.187,45-45v-90 C481,193.645,447.354,160,406,160z M451,325c0,8.271-6.729,15-15,15s-15-6.729-15-15v-96h-30v253h-30V325h-30v157h-30l0-292h30v90 h30v-90h45c24.813,0,45,20.187,45,45V325z"/></g></svg>
                        </div>

                        <div class="info">

                            <div class="info--label">
                                Max Meetings per day
                            </div>

                            <div class="info--value">
                                <?php echo $platformUser->max_meetings_per_day;?>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="col xl3  l6 m6 s12">
                    <div class="company-stats-item flex flex-center flex-dir-col center">

                        <div class="icon">
                            <svg id="Capa_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><g><path d="m406.713 15.5h-301.425c-58.056 0-105.288 47.232-105.288 105.288s47.232 105.288 105.288 105.288h76.663v85.063l-3.743-3.14c-18.503-15.527-47.457-14.265-64.538 2.818-17.9 17.9-16.728 46.349 2.737 62.681l65.543 54.998v53.004c0 8.284 6.716 15 15 15h180c8.284 0 15-6.716 15-15v-168.556c0-22.656-16.954-41.854-39.437-44.655l-80.563-10.037v-32.178h134.763c58.056 0 105.287-47.232 105.287-105.288s-47.231-105.286-105.287-105.286zm-194.763 451v-30h150v30zm136.855-168.441c7.494.934 13.146 7.333 13.146 14.885v93.556h-159.541l-66.72-55.984c-5.922-4.969-6.281-13.012-.807-18.487 6.148-6.147 17.382-6.637 24.042-1.049l28.384 23.817c9.736 8.168 24.642 1.239 24.642-11.491v-191.806c0-8.271 6.729-15 15-15s15 6.729 15 15v120c0 7.567 5.637 13.949 13.146 14.885zm57.908-101.984h-134.763v-44.575c0-24.813-20.187-45-45-45s-45 20.187-45 45v44.575h-76.663c-41.513 0-75.287-33.774-75.287-75.287s33.774-75.288 75.288-75.288h301.425c41.513 0 75.287 33.774 75.287 75.288s-33.774 75.287-75.287 75.287z"/><path d="m395.294 79.894-49.394 49.393-19.394-19.393c-5.857-5.858-15.355-5.858-21.213 0s-5.858 15.355 0 21.213l30 30c5.857 5.858 15.355 5.859 21.213 0l60-60c5.858-5.858 5.858-15.355 0-21.213-5.857-5.859-15.355-5.859-21.212 0z"/></g></svg>
                        </div>

                        <div class="info">

                            <div class="info--label">
                                Booking Type
                            </div>

                            <div class="info--value">
                                <?php echo $platformUser->booking_request_type;?>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="col xl3  l6 m6 s12">
                    <div class="company-stats-item flex flex-center flex-dir-col center">

                        <div class="icon">
                            <svg id="Layer_1" enable-background="new 0 0 512 512" height="512" viewBox="0 0 512 512" width="512" xmlns="http://www.w3.org/2000/svg"><g id="XMLID_1669_"><g id="XMLID_492_"><path id="XMLID_1247_" d="m462 20h-161c-5.522 0-10 4.478-10 10s4.478 10 10 10h161c16.542 0 30 13.458 30 30v236.869h-76.453l-74.365-42.945c4.964-.586 8.818-4.802 8.818-9.924v-56c0-5.522-4.478-10-10-10h-56c-5.522 0-10 4.478-10 10v56c0 5.522 4.478 10 10 10h10.001l.004 42.869h-274.005v-236.869c0-16.542 13.458-30 30-30h161.005c5.522 0 10-4.478 10-10s-4.478-10-10-10h-161.005c-27.57 0-50 22.43-50 50v280c0 27.57 22.43 50 50 50h148v72h-24.333c-5.522 0-10 4.478-10 10s4.478 10 10 10h164.666c5.522 0 10-4.478 10-10s-4.478-10-10-10h-24.333v-42.706l24.95-24.595 40.309 69.816c1.326 2.297 3.51 3.973 6.072 4.659.852.229 1.721.341 2.588.341 1.74 0 3.467-.454 5-1.34l60.764-35.082c4.783-2.762 6.422-8.877 3.66-13.66l-16.994-29.433h21.651c27.57 0 50-22.43 50-50v-280c0-27.57-22.43-50-50-50zm-168 188h36v36h-36zm-274 142v-23.131h274.007l.006 53.131h-86.013-158c-16.542 0-30-13.458-30-30zm198 122v-72h76v72zm173.579-16.145-41.776-72.359c-1.548-2.682-4.251-4.494-7.319-4.91-.447-.061-.896-.09-1.342-.09-2.608 0-5.136 1.021-7.02 2.878l-20.107 19.821-.013-129.872 112.465 64.948-27.218 7.502c-2.985.823-5.421 2.982-6.595 5.847-1.175 2.865-.956 6.112.592 8.794l41.776 72.359zm70.421-75.855h-33.198l-11.768-20.383 37.784-10.415c3.887-1.071 6.75-4.372 7.262-8.37.512-3.999-1.427-7.914-4.918-9.931l-6.982-4.032h41.82v23.131c0 16.542-13.458 30-30 30z"/><path id="XMLID_1269_" d="m88 76c-20.953 0-38 17.047-38 38s17.047 38 38 38 38-17.047 38-38-17.047-38-38-38zm0 56c-9.925 0-18-8.075-18-18s8.075-18 18-18 18 8.075 18 18-8.075 18-18 18z"/><path id="XMLID_1272_" d="m162 114c0 20.953 17.047 38 38 38s38-17.047 38-38-17.047-38-38-38-38 17.047-38 38zm56 0c0 9.925-8.075 18-18 18s-18-8.075-18-18 8.075-18 18-18 18 8.075 18 18z"/><path id="XMLID_1276_" d="m312 152c20.953 0 38-17.047 38-38s-17.047-38-38-38-38 17.047-38 38 17.047 38 38 38zm0-56c9.925 0 18 8.075 18 18s-8.075 18-18 18-18-8.075-18-18 8.075-18 18-18z"/><path id="XMLID_1279_" d="m424 152c20.953 0 38-17.047 38-38s-17.047-38-38-38-38 17.047-38 38 17.047 38 38 38zm0-56c9.925 0 18 8.075 18 18s-8.075 18-18 18-18-8.075-18-18 8.075-18 18-18z"/><path id="XMLID_1282_" d="m88 188c-20.953 0-38 17.047-38 38s17.047 38 38 38 38-17.047 38-38-17.047-38-38-38zm0 56c-9.925 0-18-8.075-18-18s8.075-18 18-18 18 8.075 18 18-8.075 18-18 18z"/><path id="XMLID_1286_" d="m172 188c-5.522 0-10 4.478-10 10v56c0 5.522 4.478 10 10 10h56c5.522 0 10-4.478 10-10v-56c0-5.522-4.478-10-10-10zm46 56h-36v-36h36z"/><path id="XMLID_1293_" d="m424 264c20.953 0 38-17.047 38-38s-17.047-38-38-38-38 17.047-38 38 17.047 38 38 38zm0-56c9.925 0 18 8.075 18 18s-8.075 18-18 18-18-8.075-18-18 8.075-18 18-18z"/><path id="XMLID_1295_" d="m256 40.149c2.63 0 5.21-1.069 7.069-2.93 1.86-1.86 2.931-4.439 2.931-7.07 0-2.64-1.07-5.21-2.931-7.069-1.859-1.86-4.439-2.931-7.069-2.931s-5.21 1.07-7.07 2.931c-1.86 1.859-2.93 4.439-2.93 7.069 0 2.62 1.069 5.2 2.93 7.07 1.86 1.861 4.44 2.93 7.07 2.93z"/></g></g></svg>
                        </div>

                        <div class="info">

                            <div class="info--label">
                                Minimum Notice
                            </div>

                            <div class="info--value">
                                <?php echo $platformUser->book_in_advance_days;?> days
                            </div>

                        </div>

                    </div>
                </div>

                <div class="col xl3  l6 m6 s12">
                    <div class="company-stats-item flex flex-center flex-dir-col center">

                        <div class="icon">
                            <svg id="Layer_1_1_" enable-background="new 0 0 64 64" height="512" viewBox="0 0 64 64" width="512" xmlns="http://www.w3.org/2000/svg"><path d="m56 40.10529v-28.10529c0-2.75684-2.24316-5-5-5h-2v-2c0-1.6543-1.3457-3-3-3s-3 1.3457-3 3v2h-5v-2c0-1.6543-1.3457-3-3-3s-3 1.3457-3 3v2h-6v-2c0-1.6543-1.3457-3-3-3s-3 1.3457-3 3v2h-5v-2c0-1.6543-1.3457-3-3-3s-3 1.3457-3 3v2h-2c-2.75684 0-5 2.24316-5 5v40c0 2.75684 2.24316 5 5 5h33.62347c2.07868 3.58081 5.94617 6 10.37653 6 6.61719 0 12-5.38281 12-12 0-4.83142-2.87561-8.99408-7-10.89471zm-11-35.10529c0-.55176.44824-1 1-1s1 .44824 1 1v6c0 .55176-.44824 1-1 1s-1-.44824-1-1zm-11 0c0-.55176.44824-1 1-1s1 .44824 1 1v6c0 .55176-.44824 1-1 1s-1-.44824-1-1zm-12 0c0-.55176.44824-1 1-1s1 .44824 1 1v6c0 .55176-.44824 1-1 1s-1-.44824-1-1zm-11 0c0-.55176.44824-1 1-1s1 .44824 1 1v6c0 .55176-.44824 1-1 1s-1-.44824-1-1zm-4 4h2v2c0 1.6543 1.3457 3 3 3s3-1.3457 3-3v-2h5v2c0 1.6543 1.3457 3 3 3s3-1.3457 3-3v-2h6v2c0 1.6543 1.3457 3 3 3s3-1.3457 3-3v-2h5v2c0 1.6543 1.3457 3 3 3s3-1.3457 3-3v-2h2c1.6543 0 3 1.3457 3 3v5h-50v-5c0-1.6543 1.3457-3 3-3zm0 46c-1.6543 0-3-1.3457-3-3v-33h50v20.39484c-.96082-.24866-1.96246-.39484-3-.39484-.6828 0-1.34808.07056-2 .1806v-5.1806c0-.55273-.44727-1-1-1h-6c-.55273 0-1 .44727-1 1v6c0 .55273.44727 1 1 1h2.38086c-3.23914 2.15106-5.38086 5.82843-5.38086 10 0 1.40411.25494 2.74664.70001 4zm40-16h-4v-4h4zm4 22c-5.51367 0-10-4.48633-10-10s4.48633-10 10-10 10 4.48633 10 10-4.48633 10-10 10z"/><path d="m52 49.2774v-6.2774h-2v6.2774c-.59528.34644-1 .98413-1 1.7226 0 .10126.01526.19836.02979.29553l-3.65479 2.92322 1.25 1.5625 3.65161-2.92133c.22492.08759.46753.14008.72339.14008 1.10455 0 2-.89545 2-2 0-.73846-.40472-1.37616-1-1.7226z"/><path d="m15 22h-6c-.55273 0-1 .44727-1 1v6c0 .55273.44727 1 1 1h6c.55273 0 1-.44727 1-1v-6c0-.55273-.44727-1-1-1zm-1 6h-4v-4h4z"/><path d="m26 22h-6c-.55273 0-1 .44727-1 1v6c0 .55273.44727 1 1 1h6c.55273 0 1-.44727 1-1v-6c0-.55273-.44727-1-1-1zm-1 6h-4v-4h4z"/><path d="m37 22h-6c-.55273 0-1 .44727-1 1v6c0 .55273.44727 1 1 1h6c.55273 0 1-.44727 1-1v-6c0-.55273-.44727-1-1-1zm-1 6h-4v-4h4z"/><path d="m42 30h6c.55273 0 1-.44727 1-1v-6c0-.55273-.44727-1-1-1h-6c-.55273 0-1 .44727-1 1v6c0 .55273.44727 1 1 1zm1-6h4v4h-4z"/><path d="m15 33h-6c-.55273 0-1 .44727-1 1v6c0 .55273.44727 1 1 1h6c.55273 0 1-.44727 1-1v-6c0-.55273-.44727-1-1-1zm-1 6h-4v-4h4z"/><path d="m26 33h-6c-.55273 0-1 .44727-1 1v6c0 .55273.44727 1 1 1h6c.55273 0 1-.44727 1-1v-6c0-.55273-.44727-1-1-1zm-1 6h-4v-4h4z"/><path d="m37 33h-6c-.55273 0-1 .44727-1 1v6c0 .55273.44727 1 1 1h6c.55273 0 1-.44727 1-1v-6c0-.55273-.44727-1-1-1zm-1 6h-4v-4h4z"/><path d="m15 44h-6c-.55273 0-1 .44727-1 1v6c0 .55273.44727 1 1 1h6c.55273 0 1-.44727 1-1v-6c0-.55273-.44727-1-1-1zm-1 6h-4v-4h4z"/><path d="m26 44h-6c-.55273 0-1 .44727-1 1v6c0 .55273.44727 1 1 1h6c.55273 0 1-.44727 1-1v-6c0-.55273-.44727-1-1-1zm-1 6h-4v-4h4z"/><path d="m37 44h-6c-.55273 0-1 .44727-1 1v6c0 .55273.44727 1 1 1h6c.55273 0 1-.44727 1-1v-6c0-.55273-.44727-1-1-1zm-1 6h-4v-4h4z"/></svg>
                        </div>

                        <div class="info">

                            <div class="info--label">
                                Availability
                            </div>

                            <div class="info--value">
                                <a href="#availabilityModal" class="trigger-modal">
                                    View
                                </a>
                            </div>

                        </div>

                    </div>
                </div>

                <div class="col xl3  l6 m6 s12">
                    <div class="company-stats-item flex flex-center flex-dir-col center">

                        <div class="icon">
                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M455.677,373.988C471.77,360.222,482,339.789,482,317c0-24.484-11.796-46.262-30-59.959c0-0.013,0-0.027,0-0.041c0-107.808-88.214-196-196-196c-26.897,0-52.662,4.87-76.006,14.248c0-0.083,0.006-0.165,0.006-0.248c0-41.355-33.645-75-75-75S30,33.645,30,75c0,22.789,10.23,43.222,26.323,56.988C22.871,149.566,0,184.66,0,225v30c0,8.284,6.716,15,15,15h45.574C68.229,370.513,152.94,451,256,451c16.774,0,33.014-1.789,48.158-5.232C302.744,452.627,302,459.728,302,467v30c0,8.284,6.716,15,15,15h180c8.284,0,15-6.716,15-15v-30C512,426.66,489.129,391.566,455.677,373.988z M452,317c0,24.813-20.187,45-45,45s-45-20.187-45-45s20.187-45,45-45S452,292.187,452,317z M105,30c24.813,0,45,20.187,45,45s-20.187,45-45,45S60,99.813,60,75S80.187,30,105,30z M30,240v-15c0-41.355,33.645-75,75-75s75,33.645,75,75v15H30z M256,421c-86.477,0-157.707-66.471-165.315-151H195c8.284,0,15-6.716,15-15v-30c0-40.34-22.871-75.434-56.323-93.012c5.929-5.072,11.066-11.042,15.183-17.711C193.832,99.052,223.869,91,256,91c86.956,0,158.503,67.21,165.44,152.409c-4.675-0.916-9.5-1.409-14.44-1.409c-41.355,0-75,33.645-75,75c0,22.789,10.23,43.222,26.323,56.988c-16.034,8.425-29.636,20.873-39.454,35.996C300.638,417.197,279.017,421,256,421z M482,482H332v-15c0-41.355,33.645-75,75-75c41.355,0,75,33.645,75,75V482z"/></g></g></svg>
                        </div>

                        <div class="info">

                            <div class="info--label">
                                Meeting Type
                            </div>

                            <div class="info--value">
                                Phone Call, Online
                            </div>

                        </div>

                    </div>
                </div>

<<<<<<< HEAD
                <div class="schedule-appointment-block full-width display-inline-block">
=======
            </div>

            <div class="col s12">

                <div class="schedule-appointment-block">
>>>>>>> 522f84971cba583ec372dad41944f6aba78ee8d6

                    <h3>
                        Schedule Appointment
                    </h3>

                    <div class="schedule-appointment-block--content">

                        <form action="">

                            <div class="col m6 l6">
                                <div
                                        class="calendar shippingUser col l6 m6"
                                        data-disabledates="<?php echo $platformUser->availability->excluded_dates;?>"
                                        data-disabledweekdays="<?php weekdaysDisalable($platformUser->availability->weekdays_available);?>"
                                        data-bookinadvance="<?php echo $platformUser->book_in_advance_days;?>"
                                        data-scheduledates="null/2001-01-01"
                                ></div>
                            </div>

                            <div class="col m6 l6">
                                <div class="dayDisplay">

                                </div>
                                <input type="hidden" id='shippingDay' name='shippingDay' value=''>
                                <div id="selectedShippingDates"></div>
                            </div>

                            <div class="col l12 m12 margin-top-50 margin-bottom-20">
                                <button type="submit" class="saveAvailability save-button" name="refresh_action" value="create_appointment">CREATE APPOINTMENT</button>
                            </div>

                        </form>

                    </div>

                </div>

            </div>

    </section>

    <div id="availabilityModal" class="profenda-modal">

        <div class="profenda-modal-header">
            Availability
        </div>
        <div class="profenda-modal-content">

            <table>
                <tr>
                    <th></th>
                    <th>Monday</th>
                    <th>Tuesday</th>
                    <th>Wednesday</th>
                    <th>Thursday</th>
                    <th>Friday</th>
                    <th>Saturday</th>
                    <th>Sunday</th>
                </tr>
                <tr>
                    <td>From</td>
                    <td><?php echo $platformUser->availability->mon_time_from; ?></td>
                    <td><?php echo $platformUser->availability->tue_time_from; ?></td>
                    <td><?php echo $platformUser->availability->wed_time_from; ?></td>
                    <td><?php echo $platformUser->availability->thu_time_from; ?></td>
                    <td><?php echo $platformUser->availability->fri_time_from; ?></td>
                    <td><?php echo $platformUser->availability->sat_time_from; ?></td>
                    <td><?php echo $platformUser->availability->sun_time_from; ?></td>
                </tr>
                <tr>
                    <td>To</td>
                    <td><?php echo $platformUser->availability->mon_time_to; ?></td>
                    <td><?php echo $platformUser->availability->tue_time_to; ?></td>
                    <td><?php echo $platformUser->availability->wed_time_to; ?></td>
                    <td><?php echo $platformUser->availability->thu_time_to; ?></td>
                    <td><?php echo $platformUser->availability->fri_time_to; ?></td>
                    <td><?php echo $platformUser->availability->sat_time_to; ?></td>
                    <td><?php echo $platformUser->availability->sun_time_to; ?></td>
                </tr>
            </table>

        </div>

    </div>
    <div class="modal-overlay"></div>
<?php
get_footer();

<?php

get_header();

?>

<div class="row no-margin-bottom">

	<svg class="water-effect">
		<defs>
			<!--   https://developer.mozilla.org/en-US/docs/Web/SVG/Element/filter -->
			<filter id="turbulence" x="0" y="0" width="100%" height="100%">
				<feTurbulence id="sea-filter" numOctaves="3" seed="2" baseFrequency="0.02 0.05"></feTurbulence>
				<feDisplacementMap scale="20" in="SourceGraphic"></feDisplacementMap>
				<!--     https://developer.mozilla.org/en-US/docs/Web/SVG/Element/animate -->
				<!--     <animate xlink:href="#sea-filter" attributeName="baseFrequency" dur="60s" keyTimes="0;0.5;1" values="0.02 0.06;0.04 0.08;0.02 0.06" repeatCount="indefinite" /> -->
				<animate xlink:href="#sea-filter" attributeName="baseFrequency" dur="60s" keyTimes="0;0.5;1" values="0.02 0.06;0.04 0.08;0.02 0.06" repeatCount="indefinite" calcMode="spline" keySplines="0.25 0 0.75 1;0.25 0 0.75 1"/>
			</filter>
		</defs>
	</svg>

	<section id="aboutOpener" class="relative">

		<div class="flex full-width">

			<div class="col l6 m6 s12 padding-top-50 padding-bottom-50 relative flex flex-center">

				<div class="container relative z-index-1 center">

					<h2 class="section-heading relative display-inline-block">
						About Profenda
						<span class="bg-heading">
							About us
						</span>
					</h2>

					<h3 class="section-subheading">
						Your Professional Agenda
					</h3>

					<p class="color-black center">
						Profenda is an online appointment scheduling platform that connects Shipping Companies with Suppliers. It's a professional agenda which simplifies how you schedule and run customer meetings.
						Let your clients choose how, when and where to meet you in just a few clicks.

					</p>


				</div>

			</div>

			<div class="col l6 m6 s12 no-padding-right no-padding-left water-filter">

				<div class="container padding-top-50 padding-bottom-50 relative z-index-1">

					<?php echo wp_get_attachment_image( 886, 'full' ); ?>

				</div>


			</div>

		</div>

        <svg width="1280" height="517" viewBox="0 0 1280 517" fill="none" xmlns="http://www.w3.org/2000/svg" style="position: absolute;bottom: -56%;z-index: 0;left: -10%;width: 110%;height: 100%;transform: rotate(180deg);">
            <path d="M-809 422.805C-510.936 542.865 -405.413 -3.92245 146.206 422.805C392.568 620.432 668.75 429.161 909.382 231.535C1025.49 138.777 1389.55 19.4762 1507 11" stroke="#006BFF" stroke-width="22" stroke-miterlimit="10" style="stroke: #eaf2ff;"></path>
            <path d="M909.383 231.535C668.75 429.162 392.569 620.432 146.207 422.806" stroke="#E55CFF" stroke-width="22" stroke-miterlimit="10" style="stroke: #02569c;"></path>
        </svg>

		<div class="clearfix"></div>

	</section>

	<section id="aboutOpener">

		<div class="flex full-width">

			<div class="col l6 m6 s12 no-padding-right no-padding-left water-filter">

				<div class="container padding-top-50 padding-bottom-50 relative z-index-1">

					<?php echo wp_get_attachment_image( 863, 'full' ); ?>

				</div>

			</div>

			<div class="col l6 m6 s12 padding-top-50 padding-bottom-50 relative flex flex-center">

				<div class="container relative z-index-1 center">

					<h2 class="section-heading relative display-inline-block">
						The story behind
						<span class="bg-heading">
							OUR STORY
						</span>
					</h2>

					<h3 class="section-subheading">
						The embracement of the idea
					</h3>

					<p class="color-black center">

						We live in a fast-pace environment. Especially, the shipping industry is a dynamic sector.  People onshore have to manage multiple complex situations and, at the same time, be alert at any moment.

					</p>

					<p class="color-black center">

						Everyday, procedural tasks drain us and often get done while multitasking; scheduling is one of them. This lowers our productivity, efficiency and even happiness in the moment.

					</p>

					<p class="color-black center">

						It is time to flip the situation by outsourcing what is simply a procedural task. Let’s allow our people and companies to grow through negotiating and networking.


					</p>

					<p class="color-black center">

						Now, everyone has access to a Personal Assistant. This is Profenda.

					</p>

				</div>

			</div>

		</div>

		<div class="clearfix"></div>

	</section>

	<section class="profenda-section relative padding-top-80 padding-bottom-80 bg-light-grey">

		<div class="container relative z-index-1">

			<div class="flex flex-center full-width">

				<div class="col l5 m6 s12">

					<?php echo wp_get_attachment_image( 887, 'full' ); ?>

				</div>

				<div class="col l7 m6 s12 center">

					<h2 class="section-heading relative display-inline-block">
						The Woman behind the idea
						<span class="bg-heading">
							FOUNDER
						</span>
					</h2>

					<h3 class="section-subheading">
						A smooth sea never made a skilled sailor.
					</h3>

					<p class="color-black center">

						<strong>Maria Tzigianni</strong> founded Profenda in 2021 through sheer grit and perseverance during the COVID-19 pandemic.
						With everything on the line, she set sail to her vision of creating a simple and growing scheduling platform that manages appointments for businesses in the shipping industry around the world.
					</p>

				</div>

			</div>

		</div>

        <svg width="1280" height="517" viewBox="0 0 1280 517" fill="none" xmlns="http://www.w3.org/2000/svg" style="position: absolute;top: -50px;z-index: 0;left: 0;width: 160%;height: 100%;">
            <path d="M-809 422.805C-510.936 542.865 -405.413 -3.92245 146.206 422.805C392.568 620.432 668.75 429.161 909.382 231.535C1025.49 138.777 1389.55 19.4762 1507 11" stroke="#006BFF" stroke-width="22" stroke-miterlimit="10" style="stroke: #eaf2ff;"></path>
            <path d="M909.383 231.535C668.75 429.162 392.569 620.432 146.207 422.806" stroke="#E55CFF" stroke-width="22" stroke-miterlimit="10" style="stroke: #ddeaff;"></path>
        </svg>

		<div class="clearfix"></div>

	</section>


	<section class="profenda-section relative padding-top-80 padding-bottom-80">

		<div class="flex flex-center full-width">

			<div class="col l3 m6 s12 relative">

				<div class="container relative">

					<svg class="relative z-index-1" version="1.1" id="Layer_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 1000 1000" style="enable-background:new 0 0 1000 1000;" xml:space="preserve"><path style="fill:#28AAE1;" d="M555,446.5l52.1-0.4c9.6-0.1,17.3-7.9,17.2-17.5l-0.4-52.1c-0.1-9.6-7.9-17.3-17.5-17.2l-52.1,0.4c-9.6,0.1-17.3,7.9-17.2,17.5l0.4,52.1C537.6,438.8,545.4,446.5,555,446.5"></path><path style="fill:#28AAE1;" d="M398.7,447.6l52.1-0.4c9.6-0.1,17.3-7.9,17.2-17.5l-0.4-52.1c-0.1-9.6-7.9-17.3-17.5-17.2l-52.1,0.4c-9.6,0.1-17.3,7.9-17.2,17.5l0.4,52.1C381.3,440,389.1,447.7,398.7,447.6"></path><path style="fill:#28AAE1;" d="M242.4,448.7l52.1-0.4c9.6-0.1,17.3-7.9,17.2-17.5l-0.4-52.1c-0.1-9.6-7.9-17.3-17.5-17.3l-52.1,0.4c-9.6,0.1-17.3,7.9-17.2,17.5l0.4,52.1C224.9,441.1,232.8,448.8,242.4,448.7"></path><path style="fill:#28AAE1;" d="M556.2,602.8l52.1-0.4c9.6-0.1,17.3-7.9,17.2-17.5l-0.4-52.1c-0.1-9.6-7.9-17.3-17.5-17.3l-52.1,0.4c-9.6,0.1-17.3,7.9-17.2,17.5l0.4,52.1C538.7,595.1,546.6,602.9,556.2,602.8"></path><path style="fill:#28AAE1;" d="M399.8,603.9l52.1-0.4c9.6-0.1,17.3-7.9,17.2-17.5l-0.4-52.1c-0.1-9.6-7.9-17.3-17.5-17.3l-52.1,0.4c-9.6,0.1-17.3,7.9-17.2,17.5l0.4,52.1C382.4,596.3,390.2,604,399.8,603.9"></path><path style="fill:#28AAE1;" d="M243.5,605.1l52.1-0.4c9.6-0.1,17.3-7.9,17.2-17.5l-0.4-52.1c-0.1-9.6-7.9-17.3-17.5-17.3l-52.1,0.4c-9.6,0.1-17.3,7.9-17.2,17.5l0.4,52.1C226.1,597.4,233.9,605.1,243.5,605.1"></path><path style="fill:#28AAE1;" d="M557.3,759.1l52.1-0.4c9.6-0.1,17.3-7.9,17.2-17.5l-0.4-52.1c-0.1-9.6-7.9-17.3-17.5-17.2l-52.1,0.4c-9.6,0.1-17.3,7.9-17.2,17.5l0.4,52.1C539.9,751.5,547.7,759.2,557.3,759.1"></path><path style="fill:#28AAE1;" d="M401,760.3l52.1-0.4c9.6-0.1,17.3-7.9,17.2-17.5l-0.4-52.1c-0.1-9.6-7.9-17.3-17.5-17.2l-52.1,0.4c-9.6,0.1-17.3,7.9-17.2,17.5l0.4,52.1C383.5,752.6,391.4,760.3,401,760.3"></path><path style="fill:#02569C;" d="M161.4,907.1l-5-689.8l689.8-5l0.3,44.9l90.2-0.6l-1-135.1l-133.8,1l0,2.8c0.2,31.4-25.1,57-56.4,57.2c-31.3,0.2-57-25.1-57.2-56.4l0-2.8L312.9,126l0,2.8c0.2,31.3-25.1,57-56.4,57.2c-31.3,0.2-57-25.1-57.2-56.4l0-2.8l-133.8,1L71.8,998l870.2-6.3l-1-135.1l-90.2,0.7l0.3,44.9L161.4,907.1z"></path><path style="fill:#B3D9F9;" d="M255.2,6.5c-18.5,0.1-33.4,15.2-33.2,33.7l0.6,86.4l0,2.8c0.1,18.5,15.2,33.4,33.7,33.2c18.5-0.1,33.4-15.2,33.2-33.7l0-2.8L289,39.8C288.8,21.3,273.7,6.4,255.2,6.5"></path><path style="fill:#B3D9F9;" d="M744.1,3c-18.5,0.1-33.4,15.2-33.2,33.7l0.6,86.4l0,2.8c0.1,18.5,15.2,33.4,33.7,33.2c18.5-0.1,33.4-15.2,33.2-33.7l0-2.8l-0.6-86.4C777.7,17.7,762.6,2.8,744.1,3"></path></svg>

					<h2 style="position: absolute;top: 50%;width: 100%;left: 77%;transform: translate(0, -50%);" class="section-heading display-inline-block">
						OUR VALUES
						<span class="bg-heading">
							VALUES
						</span>
					</h2>

				</div>


			</div>

			<div class="col l9 m6 s12 center relative">

                <div class="values-line"></div>

				<div class="container relative z-index-1">

					<div class="flex full-width">

                        <div class="col l4 m6 s12 no-margin-left">

                            <div class="icon-card-block">

                                <h4>
                                   Humans First
                                </h4>

                                <div class="icon">

	                                <?php echo wp_get_attachment_image( 891, 'full' ); ?>

                                </div>

                                <p>
                                    We understand that our decisions and actions impact real people. We actively pursue and thoughtfully consider the input of others.
                                </p>

                            </div>

                        </div>

                        <div class="col l4 m6 s12 no-margin-left">

                            <div class="icon-card-block">

                                <h4>
                                  WORK SMART
                                </h4>

                                <div class="icon">

	                                <?php echo wp_get_attachment_image( 889, 'full' ); ?>

                                </div>

                                <p>
                                    We are highly analytical in our approach, digging deep to discover the top priorities. We think “lean,” act resourcefully, and refuse to compromise on quality.
                                </p>

                            </div>

                        </div>

                        <div class="col l4 m6 s12 no-margin-left">

                            <div class="icon-card-block">

                                <h4>
                                  MAKE AN IMPACT
                                </h4>

                                <div class="icon">

	                                <?php echo wp_get_attachment_image( 892, 'full' ); ?>

                                </div>

                                <p>
                                    We are self-starters who crave empowerment, actively pursue opportunities for impact, take initiative, and swing big to move the needle.
                                </p>

                            </div>

                        </div>

                    </div>

				</div>

			</div>

		</div>

		<div class="clearfix"></div>

	</section>


	<section class="profenda-section relative padding-top-80 padding-bottom-80 bg-light-grey">

		<div class="container relative z-index-1">

            <h2 class="section-heading center relative">
                PROFENDA ROADMAP
                <span class="bg-heading">
                    ROADMAP
                </span>
            </h2>

            <h3 class="section-subheading center">
                Constantly Growing
            </h3>

            <p class="color-black center">
                We believe in trust and transparency in a business relationship.
                <br>Here's a roadmap of what we have achieved so far and what are the next steps of the platform.
            </p>

            <ul class="timeline margin-top-80" id="timeline">
                <li class="li complete">
                    <div class="timestamp">
                        <span class="date">11/15/2014<span>
                    </div>
                    <div class="status">
                        <h4>Build a Team</h4>
                    </div>
                </li>
                <li class="li complete">
                    <div class="timestamp">
                        <span class="date">11/15/2014<span>
                    </div>
                    <div class="status">
                        <h4>create platform</h4>
                    </div>
                </li>
                <li class="li complete">
                    <div class="timestamp">
                        <span class="date">11/15/2014<span>
                    </div>
                    <div class="status">
                        <h4>marketing strategy</h4>
                    </div>
                </li>
                <li class="li">
                    <div class="timestamp">
                        <span class="date">TBD<span>
                    </div>
                    <div class="status">
                        <h4>IMPROVE BASED ON FEEDBACK</h4>
                    </div>
                </li>
                <li class="li">
                    <div class="timestamp">
                        <span class="date">TBD<span>
                    </div>
                    <div class="status">
                        <h4>add more services</h4>
                    </div>
                </li>
            </ul>

        </div>

		<div class="clearfix"></div>

	</section>

    <section id="aboutOpener" class="relative overflow-hidden">

        <div class="flex full-width">

            <div class="col l6 m6 s12 no-padding-right no-padding-left water-filter">

                <div class="container padding-top-50 padding-bottom-50 relative z-index-1">

					<?php echo wp_get_attachment_image( 863, 'full' ); ?>

                </div>

            </div>

            <div class="col l6 m6 s12 padding-top-50 padding-bottom-50 relative flex flex-center">

                <div class="container relative z-index-1 center">

                    <h2 class="section-heading relative display-inline-block">
                       TRY PROFENDA
                        <span class="bg-heading">
							TRY NOW
						</span>
                    </h2>

                    <h3 class="section-subheading">
                        Start growing your business and work smart
                    </h3>

                    <p class="color-black center">

                        We live in a fast-pace environment. Especially, the shipping industry is a dynamic sector.  People onshore have to manage multiple complex situations and, at the same time, be alert at any moment.

                    </p>

                    <div class="flex flex-center flex-just-center margin-top-30">

                        <a href="#" class="profenda-btn cta-btn light-blue-btn">
                            FOR SUPPLIER COMPANIES
                        </a>

                        <a href="#" class="profenda-btn cta-btn">
                            FOR SHIPPING COMPANIES
                        </a>

                    </div>


                </div>

            </div>

        </div>

        <svg id="contactLines" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" width="1440" height="560" preserveAspectRatio="none" viewBox="0 0 1440 560" style="width: 92%;opacity: 0.2;"><g mask="url(&quot;#SvgjsMask1006&quot;)" fill="none"><path d="M417.94 582.71C573.22 582.71 719.72 564.43 1038.73 562.42 1357.74 560.41 1489.94 294.05 1659.52 288.02" stroke="rgba(86, 42, 240, 1)" stroke-width="2"></path><path d="M668.54 594.42C848.18 547.81 904.55 62.71 1178.99 55.42 1453.43 48.13 1557.48 188.7 1689.44 189.82" stroke="rgba(86, 42, 240, 1)" stroke-width="2"></path><path d="M402.34 650.15C539.69 599.8 487.08 189.17 761.54 188.2 1036 187.23 1289.65 436.58 1479.94 440.2" stroke="rgba(86, 42, 240, 1)" stroke-width="2"></path><path d="M181.29 623.79C305.59 622.58 420.4 491.35 660.53 491.32 900.66 491.29 900.15 561.32 1139.77 561.32 1379.39 561.32 1497.93 491.5 1619.01 491.32" stroke="rgba(86, 42, 240, 1)" stroke-width="2"></path><path d="M562.88 660.24C702.37 583.65 622.32 123.21 889.63 113.97 1156.95 104.73 1377.14 231.1 1543.14 231.57" stroke="rgba(86, 42, 240, 1)" stroke-width="2"></path></g><defs><mask id="SvgjsMask1006"><rect width="1440" height="560" fill="#ffffff"></rect></mask></defs></svg>

        <div class="clearfix"></div>

    </section>

</div>

<?php

get_footer();


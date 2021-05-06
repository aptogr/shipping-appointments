<?php

get_header();

?>


	<section id="homiLogin" class="row homi-auth-section no-margin-bottom padding-top-80 padding-bottom-80">

		<div class="container">

			<div class="col s12 flex flex-center flex-just-center">

				<div class="login-card card center display-block">

					<div class="flex">

						<div class="login-content register-content full-width">

							<div class="col s12">

								<div class="brand-logo">

									<a href="<?php echo site_url(); ?>">

										<?php echo wp_get_attachment_image( 424, 'original'); ?>

									</a>

								</div>

                                <h1 class="font-weight-700">
                                    Create an account
                                </h1>

                                <p class="account-page-description">
                                    Profenda helps shipping companies connect directly with suppliers.
                                </p>

                                <h2 class="register-type-heading">
                                   Register a new account for
                                </h2>


								<div class="flex register-types">

									<a href="<?php echo site_url('register/shipping/new-company'); ?>" class="register-type-box">

										<div class="icon">

											<svg height="512" viewBox="0 0 60 60" width="512" xmlns="http://www.w3.org/2000/svg"><g id="Page-1" fill="none" fill-rule="evenodd"><g id="023---Cruise-Ship-Front" fill="rgb(0,0,0)" fill-rule="nonzero"><path id="Shape" d="m6.11 57.375-4.843-1.339c-.34440403-.0953899-.71353641.0002035-.96834852.2507712-.25481211.2505677-.35659194.6180424-.26700001.964.08959194.3459576.35694449.6178389.70134853.7132288l4.844 1.336c3.33544883.936961 6.8645512.936961 10.2 0 2.9860113-.8378157 6.1449887-.8378157 9.131 0 3.3355128.9364968 6.8644872.9364968 10.2 0 2.9856477-.8379892 6.1443523-.8379892 9.13 0 3.3354346.9370643 6.8645654.9370643 10.2 0l4.83-1.337c.344404-.0953899.6117566-.3672712.7013485-.7132288s-.0121879-.7134323-.267-.964-.6239445-.3461611-.9683485-.2507712l-4.834 1.338c-2.9865254.8390149-6.1464746.8390149-9.133 0-1.0056971-.2757275-2.0320407-.4696927-3.069-.58l11.8-17.985c.5250909-.7946146.6394639-1.7921029.3078586-2.684947-.3316052-.8928442-1.0693743-1.5738442-1.9858586-1.833053l-2.82-.821v-13.469c0-1.6568542-1.3431458-3-3-3h-1v-9c0-1.65685425-1.3431458-3-3-3h-7v-3c0-1.1045695-.8954305-2-2-2h-6c-1.1045695 0-2 .8954305-2 2v3h-7c-1.6568542 0-3 1.34314575-3 3v9h-1c-1.6568542 0-3 1.3431458-3 3v13.469l-2.824.819c-.91759611.2586931-1.65658388.9398616-1.98901401 1.833391-.33243013.8935295-.21836376 1.8920696.30701401 2.687609l11.806 17.985c-1.0361421.1118993-2.0617208.3061808-3.067.581-2.9833796.8371946-6.13962043.8371946-9.123 0zm28.46 0c-1.1658739.3226586-2.3624607.5217545-3.57.594v-3.969c0-.5522847-.4477153-1-1-1s-1 .4477153-1 1v3.968c-1.2050576-.0748061-2.3989333-.2759081-3.562-.6-1.5706863-.4364011-3.1909782-.6689757-4.821-.692l-2.95-4.495 11.333-3.791v1.61c0 .5522847.4477153 1 1 1s1-.4477153 1-1v-1.61l11.333 3.8-2.95 4.495c-1.6271305.0246108-3.2444917.2564785-4.813.69zm-3.57-13.975 13.951 4.8-1.483 2.259-12.468-4.179zm-2 2.88-12.468 4.177-1.483-2.257 13.951-4.8zm22.938-9.462c.1116228.2965016.0744413.6285325-.1.893l-5.751 8.761-15.087-5.186v-10.955l20.276 5.881c.3052203.0838952.5515244.3093639.662.606zm-24.938-34.818h6v3h-6zm-10 6c0-.55228475.4477153-1 1-1h24c.5522847 0 1 .44771525 1 1v9h-26zm-4 12c0-.5522847.4477153-1 1-1h32c.5522847 0 1 .4477153 1 1v12.889l-16.722-4.849c-.1815442-.053-.3744558-.053-.556 0l-16.722 4.849zm-4.937 16.818c.11088599-.2982606.35889769-.5246737.666-.608l20.271-5.879v10.955l-15.083 5.186-5.75-8.76c-.17674584-.2638145-.21546585-.5966576-.104-.894z"/><path id="Shape" d="m34 27c1.6568542 0 3-1.3431458 3-3s-1.3431458-3-3-3-3 1.3431458-3 3 1.3431458 3 3 3zm0-4c.5522847 0 1 .4477153 1 1s-.4477153 1-1 1-1-.4477153-1-1 .4477153-1 1-1z"/><path id="Shape" d="m26 21c-1.6568542 0-3 1.3431458-3 3s1.3431458 3 3 3 3-1.3431458 3-3-1.3431458-3-3-3zm0 4c-.5522847 0-1-.4477153-1-1s.4477153-1 1-1 1 .4477153 1 1-.4477153 1-1 1z"/><path id="Shape" d="m18 21c-1.6568542 0-3 1.3431458-3 3s1.3431458 3 3 3 3-1.3431458 3-3-1.3431458-3-3-3zm0 4c-.5522847 0-1-.4477153-1-1s.4477153-1 1-1 1 .4477153 1 1-.4477153 1-1 1z"/><path id="Shape" d="m38 9c-1.6568542 0-3 1.3431458-3 3s1.3431458 3 3 3 3-1.3431458 3-3-1.3431458-3-3-3zm0 4c-.5522847 0-1-.4477153-1-1s.4477153-1 1-1 1 .4477153 1 1-.4477153 1-1 1z"/><path id="Shape" d="m30 9c-1.6568542 0-3 1.3431458-3 3s1.3431458 3 3 3 3-1.3431458 3-3-1.3431458-3-3-3zm0 4c-.5522847 0-1-.4477153-1-1s.4477153-1 1-1 1 .4477153 1 1-.4477153 1-1 1z"/><path id="Shape" d="m22 9c-1.2133867 0-2.3072956.73092653-2.7716386 1.8519497-.464343 1.1210232-.2076757 2.4113767.6503183 3.2693706.8579939.857994 2.1483474 1.1146613 3.2693706.6503183s1.8519497-1.5582519 1.8519497-2.7716386c0-1.6568542-1.3431458-3-3-3zm0 4c-.5522847 0-1-.4477153-1-1s.4477153-1 1-1 1 .4477153 1 1-.4477153 1-1 1z"/><path id="Shape" d="m42 27c1.6568542 0 3-1.3431458 3-3s-1.3431458-3-3-3-3 1.3431458-3 3 1.3431458 3 3 3zm0-4c.5522847 0 1 .4477153 1 1s-.4477153 1-1 1-1-.4477153-1-1 .4477153-1 1-1z"/></g></g></svg>

										</div>

										<h3>
											New Shipping Company
										</h3>

									</a>

									<a href="<?php echo site_url('register/shipping/employee'); ?>" class="register-type-box">

										<div class="icon">

                                            <svg version="1.1" id="Capa_1" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" x="0px" y="0px" viewBox="0 0 512 512" style="enable-background:new 0 0 512 512;" xml:space="preserve"><g><g><path d="M421.054,414.843c-4.142,0-7.5,3.358-7.5,7.5v70.514c0,2.283-1.858,4.141-4.141,4.141h-40.317V349.301c0-4.142-3.358-7.5-7.5-7.5c-4.142,0-7.5,3.358-7.5,7.5v147.698h-81.185l23.543-25.9c2.572-2.83,3.785-6.861,3.244-10.787c-0.01-0.076-0.022-0.152-0.035-0.228L277.24,327.617l6.041-9.094c3.34,2.372,5.913,4.656,10.738,4.656c4.908,0,9.497-2.747,11.755-7.269v-0.001l23.65-47.4l53.876,20.865c1.949,0.836,30.252,13.582,30.252,47.238v50.73c-0.001,4.141,3.357,7.5,7.5,7.5c4.142,0,7.5-3.358,7.5-7.5v-50.73c0-44.344-37.969-60.463-39.585-61.128c-0.047-0.02-0.095-0.039-0.143-0.057l-89.668-34.726v-21.03c14.242-11.076,24.117-27.495,26.596-46.227c7.101-0.5,13.69-3.152,19.071-7.779c7.027-6.043,11.059-14.838,11.059-24.126c0-7.708-2.781-15.068-7.737-20.803V92.953C348.144,41.699,306.446,0,255.192,0c-51.254,0-92.952,41.699-92.952,92.953v28.511c-5.009,5.677-7.733,12.665-7.733,20.074c0,9.291,4.03,18.085,11.059,24.129c5.377,4.625,11.962,7.274,19.061,7.775c2.499,19.083,12.662,36.114,28.117,47.339v19.92l-89.571,34.725c-0.047,0.018-0.094,0.037-0.141,0.056c-1.617,0.665-39.585,16.784-39.585,61.128v156.245c0,10.555,8.587,19.142,19.142,19.142h71.457c4.142,0,7.5-3.358,7.5-7.5c0-4.142-3.358-7.5-7.5-7.5h-16.137V349.301c0-4.142-3.358-7.5-7.5-7.5c-4.142,0-7.5,3.358-7.5,7.5v147.698h-40.319c-2.283,0-4.141-1.858-4.141-4.141V336.611c0-33.769,28.493-46.486,30.243-47.234l53.834-20.87l23.652,47.402c2.263,4.533,6.858,7.27,11.756,7.27c4.801,0,7.349-2.249,10.738-4.656l6.041,9.094l-22.421,132.468c-0.013,0.075-0.024,0.15-0.035,0.226c-0.542,3.924,0.671,7.957,3.244,10.789l23.543,25.9h-29.995c-4.142,0-7.5,3.358-7.5,7.5s3.358,7.5,7.5,7.5h200.365c10.555,0,19.142-8.588,19.142-19.142v-70.514C428.554,418.201,425.196,414.843,421.054,414.843z M315.375,263.069l-22.049,44.19c-0.548-0.389-12.233-8.691-26.517-18.834c6.198-7.651-1.053,1.299,27.235-33.617L315.375,263.069z M271.043,309.833l-5.718,8.607h-18.703l-5.718-8.607l15.07-10.703L271.043,309.833z M227.743,243.121v-14.036c9.112,3.673,18.85,5.376,28.36,5.376c9.833,0,19.476-2.096,28.052-5.846v14.567l-28.181,34.785L227.743,243.121z M340.881,141.539c-0.001,4.913-2.129,9.562-5.839,12.753c-2.453,2.11-5.416,3.459-8.661,3.987v-33.477C335.001,126.202,340.881,133.352,340.881,141.539z M184.007,158.279c-8.718-1.415-14.5-8.623-14.5-16.741c0-8.018,6.647-14.544,14.5-16.359V158.279z M184.41,109.896c-2.389,0.274-5.127,0.921-7.168,1.615V92.953c0-42.983,34.968-77.952,77.951-77.952c42.983,0,77.951,34.969,77.951,77.952v18.043c-2.18-0.663-4.441-1.101-6.762-1.307c0-7.237,0.063-5.841-23.612-31.294c-4.354-4.678-11.556-5.658-17.037-2.077c-26.13,17.069-58.005,25.644-87.415,23.532C191.867,99.367,185.991,103.616,184.41,109.896z M199.008,164.184v-46.792v-2.465c32.375,1.896,66.318-7.722,93.739-25.283c10.858,11.658,16.738,17.773,18.634,20.099c0,5.884,0,47.705,0,54.44c0,30.447-24.826,55.276-55.277,55.276C221.91,219.46,199.008,192.934,199.008,164.184z M218.623,307.259l-22.049-44.19l21.293-8.247l27.241,33.625C231.255,298.284,219.88,306.366,218.623,307.259z M227.228,461.702l21.709-128.263h14.071l21.709,128.263l-28.744,31.623L227.228,461.702z"/></g></g></svg>

										</div>

										<h3>
											Employee
										</h3>

									</a>

								</div>


							</div>

						</div>

					</div>

				</div>

			</div>

		</div>

		<div class="clearfix"></div>

	</section>

<?php
get_footer();
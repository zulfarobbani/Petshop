		<div class="body" data-spy="scroll" data-target="#sidebar" data-offset="120">
			<header id="header" class="header-effect-shrink" data-plugin-options="{'stickyEnabled': true, 'stickyEffect': 'shrink', 'stickyEnableOnBoxed': true, 'stickyEnableOnMobile': true, 'stickyChangeLogo': true, 'stickyStartAt': 30, 'stickyHeaderContainerHeight': 70}">
				<div class="header-body">
					<div class="header-container container">
						<div class="header-row">
							<div class="header-column">
								<div class="header-row">
									<div class="header-logo">
										<a href="index.html">
											<img alt="Porto" width="100" height="70" data-sticky-width="82" data-sticky-height="40" src="/assets/img/logo_sambat_fauna_shop.svg">
										</a>
									</div>
								</div>
							</div>
							<div class="header-column justify-content-end">
								<div class="header-row">
									<div class="header-nav header-nav-links justify-content-start order-2 order-lg-1">
										<div class="header-nav-main header-nav-main-square header-nav-main-effect-2 header-nav-main-sub-effect-1">
											<nav class="collapse">
												<ul class="nav nav-pills" id="mainNav">
													<?php foreach ($permission as $key => $value) { ?>
														<?php if ($value['menu'] == 'dashboard') { ?>
															<li class="dropdown">
																<a class="dropdown-item dropdown-toggle text-white" href="/dashboard">
																	Dashboard
																</a>
															</li>
														<?php } ?>
														<?php if ($value['menu'] == 'product') { ?>
															<li class="dropdown dropdown-mega">
																<a class="dropdown-item dropdown-toggle text-white" href="/produk">
																	Product
																</a>
															</li>
														<?php } ?>
														<?php if ($value['menu'] == 'transaction') { ?>
															<li class="nav-item dropdown">
																<a class="nav-link dropdown-toggle text-white" href="#" id="navbarDropdownMenuLink" role="button" data-bs-toggle="dropdown" aria-expanded="false">
																	Transaction
																</a>
																<ul class="dropdown-menu dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
																	<li><a class="dropdown-item" href="/transaksi/grosir">Grosir</a></li>
																	<li><a class="dropdown-item" href="/transaksi/eceran">Eceran</a></li>
																</ul>
															</li>
														<?php } ?>
														<?php if ($value['menu'] == 'users') { ?>
															<li class="dropdown">
																<a class="dropdown-item dropdown-toggle text-white" href="/users">
																	Users
																</a>
															</li>
														<?php } ?>
													<?php } ?>
												</ul>
											</nav>
										</div>
										<button class="btn header-btn-collapse-nav" data-toggle="collapse" data-target=".header-nav-main nav">
											<i class="fas fa-bars"></i>
										</button>
									</div>
									<div class="header-nav-features header-nav-features-no-border header-nav-features-lg-show-border order-1 order-lg-2">
										<div class="nav-item dropdown">
											<a class="nav-link" id="navbarDropdownMenuLink" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><span class="material-icons-outlined text-white fs-2">account_circle</span>
											</a>
											<div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
												<a class="dropdown-item" href="/profile">Profile</a>
												<a class="dropdown-item" href="/akun">Edit Akun</a>
												<a class="dropdown-item" href="/logout">Logout</a>
											</div>
										</div>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
			</header>
		</div>
<div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
                	<form action="search.html" class="mobile-view">
						<input class="form-control" type="text" placeholder="Search here">
						<button class="btn" type="button"><i class="fa fa-search"></i></button>
					</form>
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							<li class="nav-item nav-profile">
				              <a href="#" class="nav-link">
				                <div class="nav-profile-image">
				                  <img src="data:<?php echo $profil['photoMime']?>;base64, <?php echo $profil['photo64']?>" alt="profile">
				                  
				                </div>
				                <div class="nav-profile-text d-flex flex-column">
				                  <span id="nom" class="font-weight-bold mb-2"><?php echo  $this->session->userPrenom.' '.$this->session->userNom ; ?></span>
				                  <span class="text-white text-small" id="fonction"><?php echo$this->session->libelle_fonction; ?></span>
				                  <span class="text-white text-small" id="etablissement"><?php echo$this->session->libelle_etablissement; ?></span>
				                </div>
				                <i class="mdi mdi-bookmark-check text-success nav-profile-badge"></i>
				              </a>
				            </li>
							<li class="menu-title"> 
								<span>Main</span>
							</li>
							

							
							
							
								<?php if($isEmpList) { ?>
									<li class="submenu">
									<a href="#"><i class="fa fa-address-book-o"></i> <span> Gestion Employés</span> <span class="menu-arrow"></span></a>
								<ul class="sub-menus">
									<li class="principal-items" ><a href="#" id="liste-employe" <?php echo $actif=="EmpList"?  'class="active"':''; ?>>Liste</a></li>
									<li class="principal-items" ><a href="#" id="gestion-employee" >Profil</a></li>
									
								</ul>

								<?php } else { ?>
									<li>
									<a href="<?php echo base_url();?>RH_main"><i class="fa fa-address-book-o"></i> <span>Gestion Employés</span></a>
								<?php } ?>
								
							</li>
							<li> 
								<a href="<?php echo base_url();?>AddEmploye" <?php echo $actif=="addEmp"? 'class="active"':''; ?>><i class="fa fa-plus-square-o"></i> <span>Ajouter Employé</span></a>
							</li>
							<li> 
								<a href="<?php echo base_url();?>Organisation" <?php echo $actif=="organisation"? 'class="active"':''; ?>><i class="fa fa-sitemap"></i> <span>Gestion Organisation</span></a>
							</li>
							<li> 
								<a href="<?php echo base_url();?>Entreprise" <?php echo $actif=="entreprise"? 'class="active"':''; ?>><i class="fa fa-building-o fa-sm"></i> <span>Profil Entreprise</span></a>
							</li>
						</ul>
					</div>
                </div>
            </div>
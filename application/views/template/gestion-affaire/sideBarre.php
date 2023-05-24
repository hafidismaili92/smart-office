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
							

							
							
							
								<?php if($ismesAffaires) { ?>
									<li class="submenu">
									<a href="#"><i class="feather-grid"></i> <span> Mes Projets</span> <span class="menu-arrow"></span></a>
								<ul class="sub-menus">
									<li><a href="#" id="mesaffaires" <?php echo $actif=="mesAffaires"?  'class="active"':''; ?>>Liste</a></li>
									<li><a href="#" id="affaire-missions-items" >Missions</a></li>
									
								</ul>

								<?php } else { ?>
									<li>
									<a href="<?php echo base_url();?>Users_main"><i class="feather-grid"></i> <span>Mes Projets</span></a>
								<?php } ?>
								
							</li>
							<li> 
								<a href="<?php echo base_url();?>Taches" <?php echo $actif=="mesTaches"? 'class="active"':''; ?>><i class="feather-check-square"></i> <span>Mes Tâches</span></a>
							</li>
							<li> 
								<a href="<?php echo base_url();?>GlobalView" <?php echo $actif=="globalView"? 'class="active"':''; ?>><i class="fa fa-tachometer fa-sm"></i> <span>Vue Globale</span></a>
							</li>
							<li> 
								<a href="<?php echo base_url();?>MesDocuments" <?php echo $actif=="mesDocuments"? 'class="active"':''; ?>><i class="fa fa-file-text fa-sm"></i> <span>Mes Document</span></a>
							</li>
							<li> 
								<a href="<?php echo base_url();?>Edocuments" <?php echo $actif=="edocuments"? 'class="active"':''; ?>><i class="fa fa-file-pdf-o"></i> <span>E-documents</span></a>
							</li>
							
						</ul>
					</div>
                </div>
            </div>
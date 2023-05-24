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
							

							
							
							
								<?php if($isContrat) { ?>
									<li class="submenu">
									<a href="#"><i class="fa fa-th-list fa-sm"></i> <span> Gestion Contrat</span> <span class="menu-arrow"></span></a>
								<ul class="sub-menus">
									<li class="principal-items" ><a href="#" id="contrat-menu-listeContrat" <?php echo $actif=="contratList"?  'class="active"':''; ?>>Liste Contrats</a></li>
									<li class="principal-items" ><a href="#" id="contrat-menu-listeFacture"  >Liste Factures</a></li>
									<li class="principal-items" ><a href="#" id="contrat-menu-addFacture" >Ajouter Facture</a></li>
									
								</ul>

								<?php } else { ?>
									<li>
									<a href="<?php echo base_url();?>Contrat_main"><i class="fa fa-th-list"></i> <span>Gestion Contrat</span></a>
								<?php } ?>
								
							</li>
							<li> 
								<a href="<?php echo base_url();?>Dashboard" <?php echo $actif=="dashboard"? 'class="active"':''; ?>><i class="fa fa-tachometer fa-sm"></i> <span>Tableau de Bord</span></a>
							</li>
							<li> 
								<a href="<?php echo base_url();?>NewContrat" <?php echo $actif=="nouveauContrat"? 'class="active"':''; ?>><i class="fa fa-plus-square-o fa-sm"></i> <span>Nouveau Contrat</span></a>
							</li>
							
							<li> 
								<a href="<?php echo base_url();?>Devis" <?php echo $actif=="devis"? 'class="active"':''; ?>><i class="fa fa-file-text-o fa-sm"></i> <span>Gestion Devis</span></a>
							</li>
							<li> 
								<a href="<?php echo base_url();?>Clients" <?php echo $actif=="client"? 'class="active"':''; ?>><i class="fa fa-users fa-sm"></i> <span>Gestion Clients</span></a>
							</li>
							
							
						</ul>
					</div>
                </div>
            </div>
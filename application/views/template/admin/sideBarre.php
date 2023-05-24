<div class="sidebar" id="sidebar">
                <div class="sidebar-inner slimscroll">
                	<form action="search.html" class="mobile-view">
						<input class="form-control" type="text" placeholder="Search here">
						<button class="btn" type="button"><i class="fa fa-search"></i></button>
					</form>
					<div id="sidebar-menu" class="sidebar-menu">
						<ul>
							
							<li class="menu-title"> 
								<span>Main</span>
							</li>
							
							<li> 
								<a href="<?php echo base_url();?>demandesView" <?php echo $actif=="demande-inscription"? 'class="active"':''; ?>><i class="feather-check-square"></i> <span>Demandes d'inscription</span></a>
							</li>
							<li> 
								<a href="<?php echo base_url();?>listeView" <?php echo $actif=="liste-entreprises"? 'class="active"':''; ?>><i class="feather-check-square"></i> <span>Entreprises enregistrées</span></a>
							</li>
							<li> 
								<a href="<?php echo base_url();?>logOutAdmin" ><i class="feather-log-out"></i> <span>Déconnection</span></a>
							</li>
						</ul>
					</div>
                </div>
            </div>
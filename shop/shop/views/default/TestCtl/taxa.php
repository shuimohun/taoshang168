<?php include $this->view->getTplPath() . '/' . 'header.php'; ?>
<link rel="icon" type="http://www.antmaps.org/image/png" href="http://www.antmaps.org/img/spp.png">
<link rel="stylesheet" href="<?=$this->view->css?>/ant/bootstrap.min.css" >
<link rel="stylesheet" href="<?=$this->view->css?>/ant/css.css?family=Dosis">
<link rel="stylesheet" href="<?=$this->view->css?>/ant/hover-min.css">
<link rel="stylesheet" href="<?=$this->view->css?>/ant/main.css">
<link rel="stylesheet" href="<?=$this->view->css?>/ant/map.css">
<link rel="stylesheet" href="<?=$this->view->css?>/ant/leaflet.css" type="text/css" />
<link rel="stylesheet" href="<?=$this->view->css?>/ant/jquery-ui.min.css" />
<style>#main,#side{padding-top:110px;}#side label,#querySpecies h4,#diversity-genus-legend-title,.legendRow span{color:#000;}</style>

<div id="side">
    <div id="side-content-rtl" style="background-color: #e2e2e2">
        <div id="side-content-ltr"> <!-- rtl and ltr for right-scrollbar -->
            <div id="mode-buttons">
                <button id="diversity-button" class="button button--winona button--all" data-text="Diversity View"
                        onclick="controls.setMode('diversityMode', true);">
                    <span>Diversity View </span></button>
                <button id="species-button" class="button button--winona button--all" data-text="Species Range Maps"
                        onclick="controls.setMode('speciesMode', true);">
                    <span>Species Range Maps</span></button>
                <button id="diveristy-bentity-button" class="button button--winona button--all" data-text="Region Comparison"
                        onclick="controls.setMode('diversityBentityMode', true);">
                    <span>Region Comparison</span></button>
            </div>
            <div id="spp_view" class="none mode-controls">
                <div id="querySpecies">
                    <h4>Start typing a species</h4>
                    <input id="species-autocomplete"/>
                    <h4> OR &ndash; browse by: </h4>
                    <label> Subfamily </label><br>
                    <select id="sppView-subfamily-select" name="subfamily" disabled="disabled">
                        <option value="">Loading...</option>
                    </select><br>

                    <label> Genus </label><br>
                    <select id="sppView-genus-select" name="genus" disabled="disabled">
                        <option value="">Loading...</option>
                    </select><br>

                    <label> Species </label><br>
                    <select id="sppView-species-select" name="species" disabled="disabled">
                        <option value="">Select Species</option>
                    </select><br>
                    <div id="spp-prev_next">
                        <a id="sppView-prev" class="prev-button">Prev</a> <a id="sppView-next" class="next-button">Next</a>
                    </div>
                    <br><br>
                </div>
                <a id ="legendInfo" href="about.html#legendCode" class="hvr-shrink"></a>
                <div id = "species-legend"></div>

            </div> <!-- end spp_view -->
            <div id="diversity_view" class="none mode-controls">
                <div id="queryGenus">
                    <label> Subfamily </label><br>
                    <select id="diversityView-subfamily-select" name="subfamily" disabled>
                        <option value="">Loading...</option>
                    </select><br>
                    <div id="subfamily-prev_next">
                        <a id="diversityView-subfamily-prev" class="prev-button">Prev</a> <a id="diversityView-subfamily-next" class="next-button">Next</a>
                    </div>
                    <br>

                    <label> Genus </label>
                    <select id="diversityView-genus-select" name="genus" disabled>
                        <option value="">Loading...</option>
                    </select><br>
                    <div id="genus-prev_next">
                        <a id="diversityView-genus-prev" class="prev-button">Prev</a> <a id="diversityView-genus-next" class="next-button">Next</a>
                    </div>
                    <br><br>
                </div>


                <div id="diversity-genus-legend-title" class="none"> Number of species by region </div>
                <div id = "diversity-genus-legend"> </div>
            </div><!-- end diversity_view -->
            <div id="bentity_view" class="none mode-controls">

                <div id="bentity-description" class="pulse"> Click on a region <br> <span style="font-size:12px;">OR</span></div>

                <div id="queryBentity">
                    <h4> Select a region: </h4>
                    <label> Region </label>
                    <select id="bentityView-bentity-select" name="bentity" disabled>
                        <option>Loading...</option>
                    </select><br>
                </div>

                <div id="diversity-bentity-legend-title" class="none"> Number of species in common </div>
                <div id="diversity-bentity-legend"> </div>
            </div><!-- end bentity_view -->
        </div> <!-- end side-content-ltr -->
    </div> <!-- end side-content-rtl -->
</div> <!-- end side -->
<div id="main">
    <div id="loading-message">
        <img src='http://www.antmaps.org/img/ajax-loader.gif' />
    </div>
    <div id="current-selection-title"></div>
    <div id="current-selection"></div>
    <!-- target="_blank" to open link in new tab-->
    <p id="see-on"></p>
    <a href="http://www.antweb.org" target="_blank"><div id="antWeb"></div></a>
    <a href="http://www.antwiki.org" target="_blank"><div id="antWiki"></div></a>

    <a id ="resetZoom1" data-title="RESET ZOOM" data-html="true" rel="tooltip" href="#" onclick="baseMap.resetZoom();"><div class="hvr-shrink" id="resetZoom">
        </div></a>

    <a id ="resetAll1" data-title="RESET ALL" data-html="true" data-clicked="no" rel="tooltip" href="#" onclick="controls.resetMap();" >
        <div id="resetAll" class="hvr-shrink"></div></a>


    <div id="view-description"></div>

    <div id="select-bentity-button" class="pulse" onclick="diversityBentityMode.selectBentityView()">Map a Different Region</div>

    <div id="mapContainer">
    </div>


</div>
<div id="info-panel">
    <div id="close-info">X</div>
</div>

<script src="<?=$this->view->js?>/ant/jquery.js"></script>
<script src="<?=$this->view->js?>/ant/bootstrap.min.js"></script>
<script src="<?=$this->view->js?>/ant/d3.v3.min.js" charset="utf-8"></script>
<script src="<?=$this->view->js?>/ant/d3.geo.projection.v0.min.js"></script>
<script src="<?=$this->view->js?>/ant/topojson.min.js"></script>
<script src="<?=$this->view->js?>/ant/leaflet.js" type="text/javascript"></script>
<script src="<?=$this->view->js?>/ant/jquery-ui.js" type="text/javascript"></script>

<!-- Antmaps project files -->
<script src="<?=$this->view->js?>/ant/controls.js" type="text/javascript"></script>
<script src="<?=$this->view->js?>/ant/speciesMode.js" type="text/javascript"></script>
<script src="<?=$this->view->js?>/ant/diversityMode.js" type="text/javascript"></script>
<script src="<?=$this->view->js?>/ant/diversityBentityMode.js" type="text/javascript"></script>
<script src="<?=$this->view->js?>/ant/baseMap.js" type="text/javascript"></script>
<script src="<?=$this->view->js?>/ant/mapUtilities.js" type="text/javascript"></script>

<?php include $this->view->getTplPath() . '/' . 'footer.php'; ?>


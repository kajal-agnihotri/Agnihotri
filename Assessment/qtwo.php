<?php
error_reporting(1);
$conn = new mysqli("localhost", "root", "", "assessment_database");
$data = ("SELECT * FROM `assdt_sidebar` ORDER BY `assdt_sidebar`.`active_link_name` ASC");
$sidebarData = mysqli_query($conn, $data);

?>
<aside>
    <div id="sidebar" class="nav-collapse">
        <!-- sidebar menu start-->
        <div class="leftside-navigation">
            <ul class="sidebar-menu" id="nav-accordion">
                <?php
                while ($sidebar = $sidebarData->fetch_assoc()) {
                    if ($sidebar["parent_id"] == 0) {
                        $data = ("SELECT * FROM `assdt_sidebar` where parent_id=" . $sidebar["sidebar_id"]);
                        $subsidebarData = mysqli_query($conn, $data);
                        if ($subsidebarData->num_rows > 0) {

                          ?>
                            <li>

                                <a class="active" href="<?php echo $sidebar['active_link_url']; ?><?php echo $sidebar['link_url']; ?>">
                                    <i class="<?php echo $sidebar['tab_icon_class']; ?>"></i>
                                    <span><?php echo $sidebar['tab_name']; ?></span>
                                    <span class="dcjq-icon"></span>
                                </a>
                                <ul class="sub" style="display: none;">
                                    <?php
                                    while ($subsidebar = $subsidebarData->fetch_assoc()) {
                                    ?>
                                        <li><a href="<?php echo $subsidebar['link_url'] ?>"><?php echo $subsidebar['tab_name'] ?></a></li>
                                    <?php
                                    }

                                    ?>
                                </ul>
                            </li>
                        <?php } else {
                        ?>
                            <li>

                                <a class="active" href="<?php echo $sidebar['active_link_url']; ?><?php echo $sidebar['link_url']; ?>">
                                    <i class="<?php echo $sidebar['tab_icon_class']; ?>"></i>
                                    <span><?php echo $sidebar['tab_name']; ?></span>

                                </a>
                            </li>
                <?php
                        }
                    } else {
                    }
                }




                ?>
            </ul>
        </div>
        <!-- sidebar menu end-->
    </div>

</aside>
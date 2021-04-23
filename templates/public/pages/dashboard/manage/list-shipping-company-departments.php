<?php
global $post;

$logedInUser = new \ShippingAppointments\Service\Entities\User\PlatformUser( get_current_user_id() );
$shippingCompany = new \ShippingAppointments\Service\Entities\ShippingCompany($logedInUser->shipping_company_id);

//echo "<pre>";
//var_dump($company);
//echo "</pre>";

$depListArgs = array(
    'post_type' => 'shipping_department',
    'meta_query' => array(
        array(
            'key'       => 'shipping_department_company',
            'value'     => $logedInUser->shipping_company_id,
        )
    )
);

$departments = get_posts( $depListArgs );

?>

<div class="row list-shipping-company-departments full-width">

    <div class="full-width margin-bottom-50">
        <h2><?php echo $shippingCompany->post->post_title; ?></h2>
    </div>

    <?php

    foreach ( $departments as $key => $department ) {
        $departmentObj = new \ShippingAppointments\Service\Entities\Department($department->ID);
//        echo "<pre>";
//        var_dump($departmentObj->postMeta);
//        echo "</pre>";
        ?>
        <div class="department-item flex flex-center full-width">

            <div class="icon relative z-index-1">
                <?php echo $departmentObj->departmentType->svg; ?>
            </div>

            <div class="department-info relative z-index-1 flex flex-center">

                <h3 class="no-margin-bottom">
                    <?php echo $departmentObj->departmentType->term->name; ?>
                </h3>
                <a href="/dashboard/manage/edit-departments/department/<?php echo $department->ID; ?>/" class="book-department">
                    Edit Department
                </a>

            </div>

        </div>


        <?php

    }
    ?>
</div>

<?php
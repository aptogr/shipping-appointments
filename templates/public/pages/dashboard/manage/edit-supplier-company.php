<?php

use ShippingAppointments\Service\Entities\SupplierCompany;
use ShippingAppointments\Service\Entities\User\PlatformUser;
use ShippingAppointments\Service\Invitation\InvitationFormSupplier;

get_header();

$logedInUserObj = new PlatformUser( get_current_user_id() );

$supplier_company_id = $logedInUserObj->supplier_company_id;
$companyObj = new SupplierCompany($supplier_company_id);
$invitationForm = new InvitationFormSupplier();

?>

<?php
//echo "<pre>";
//var_dump($companyObj);
//echo "</pre>";
?>

    <div class="manage-company full-width padding-bottom-50">

        <section class="dashboard-template-opener full-width padding-top-30 padding-bottom-30 display-inline-block">

            <div class="container relative z-index-1">

                <div class="col s12">

                    <div class="flex flex-center full-width">

                        <div class="dashboard-template-opener-image display-inline-block">
                            <?php echo get_the_post_thumbnail( $companyObj->ID, 'thumbnail'); ?>
                        </div>

                        <div class="dashboard-template-opener-title display-inline-block">
                            <h1>
                                <?php echo $companyObj->post->post_title; ?>
                            </h1>

                            <?php echo get_the_content( $companyObj->ID ); ?>

                        </div>

                    </div>

                </div>

            </div>

        </section>

    <div class="full-width">

        <div class="container">

            <div class="row company-settings no-margin-bottom full-width">

                <div id="main-navigation" class="margin-top-50">

                    <ul class="links-container">

                        <li class="tab-link">
                            Company Profile Settings
                        </li>

                        <li class="tab-link">
                            Products and Brands
                        </li>

                        <li class="tab-link">
                            Manage Employees
                        </li>

                        <li class="tab-link">
                            Invitations
                        </li>

                    </ul>

                </div>

                <article id="pages-container">

                    <div id="pages-container-inner">

                        <div class="swiper-wrapper">

                            <div class="swiper-slide">

                                <div class="col s12 margin-top-50 swiper-no-swiping">

                                    <form action="" method="post" enctype="multipart/form-data">

                                        <input type="hidden" name="companyId" value="<?php echo $supplier_company_id; ?>" >

                                        <section class="main-section full-width setting-field-wrapper">

                                            <div class="full-width">

                                                <h2>Company Email</h2>
                                            </div>

                                            <div id="company_users_visibility_section" class="full-width relative margin-top-20">

                                                <input type="text" class="width300" name="company_email" value="<?php echo $companyObj->company_email;?>">

                                            </div>

                                        </section>

                                        <section class="main-section full-width setting-field-wrapper">

                                            <div class="full-width">
                                                <h2>Company Phone</h2>
                                            </div>

                                            <div id="company_users_visibility_section" class="full-width relative margin-top-20">

                                                <input type="text" class="width300" name="company_phone" value="<?php echo $companyObj->company_phone;?>">

                                            </div>

                                        </section>

                                        <section class="main-section full-width setting-field-wrapper">

                                            <div class="full-width">
                                                <h2>Upload Icon</h2>
                                            </div>

                                            <div id="company_users_visibility_section" class="drop-zone full-width relative margin-top-20">

                                                <span class="drop-zone__prompt">Drop file here or click to upload</span>
                                                <input id="file" type="file" name="logo" class="drop-zone__input">

                                            </div>

                                        </section>

                                        <section class="main-section full-width setting-field-wrapper">

                                            <button type="submit" class="save-button" name="refresh_action" value="update_supplier_company_info">Save Settings</button>

                                        </section>

                                    </form>

                                </div>

                            </div>

                            <div class="swiper-slide">

                                <div class="col s12 margin-top-50 swiper-no-swiping">

                                    <form action="" method="post" enctype="multipart/form-data">

                                        <input type="hidden" name="companyId" value="<?php echo $supplier_company_id; ?>">

                                        <section class="main-section full-width setting-field-wrapper">

                                            <div class="full-width">
                                                <h2>Products</h2>
                                                <p>Select your products.</p>
                                            </div>

                                            <div id="getProducts" class="full-width relative">

                                                <input id="getProductsInput" type="text" placeholder="Type to search..">

                                                <div class="row flex">
                                                    <div id="getProductsResults" class="relative col l6 m6"></div>

                                                    <div class="col l6 m6">
                                                        <div id="selectedProducts" class="relative flex">

                                                            <?php

                                                            $allProducts = [];


                                                            if ((!empty($companyObj->productCategories))) {

                                                                foreach ($companyObj->productCategories as $selected_product) {

                                                                    array_push($allProducts, $selected_product->term_id);

                                                                    ?>
                                                                    <div class="product-item product-item-<?php echo $selected_product->term_id; ?>" data-id="<?php echo $selected_product->term_id; ?>"><?php echo $selected_product->name;?></div>
                                                                    <?php

                                                                }

//                                                                $allProducts
                                                                $allProducts = implode(",", $allProducts);
                                                            }

                                                            ?>

                                                        </div>
                                                        <input type="hidden" name="selected_products" id="selectedProductsInput" value="<?php echo $allProducts;?>">
                                                    </div>
                                                </div>

                                            </div>

                                        </section>

                                        <section class="main-section full-width setting-field-wrapper">

                                            <div class="full-width">
                                                <h2>Brands</h2>
                                                <p>Select your Brands.</p>
                                            </div>

                                            <div id="getBrands" class="full-width relative">

                                                <input id="getBrandsInput" type="text" placeholder="Type to search..">

                                                <div class="row flex">
                                                    <div id="getBrandsResults" class="relative col l6 m6"></div>

                                                    <div class="col l6 m6">
                                                        <div id="selectedBrands" class="relative flex">

                                                            <?php

                                                            $allBrands = [];

                                                            if ((!empty($companyObj->brands))) {

                                                                foreach ($companyObj->brands as $selected_brand) {

                                                                    array_push($allBrands, $selected_brand->term_id);

                                                                    ?>
                                                                    <div class="brand-item brand-item-<?php echo $selected_brand->term_id; ?>" data-id="<?php echo $selected_brand->term_id; ?>"><?php echo $selected_brand->name;?></div>
                                                                    <?php

                                                                }
                                                            }

                                                            $allBrands = implode(",", $allBrands);

                                                            ?>

                                                        </div>
                                                        <input type="hidden" name="selected_brands" id="selectedBrandsInput" value="<?php echo $allBrands;?>">
                                                    </div>
                                                </div>

                                            </div>

                                        </section>

                                        <section class="main-section full-width setting-field-wrapper">

                                            <button type="submit" class="save-button" name="refresh_action" value="update_supplier_company_info">Save Settings</button>

                                        </section>

                                    </form>



                                </div>

                            </div>

                            <div class="swiper-slide">

                                <div class="col s12 margin-top-50 swiper-no-swiping">

                                        <h2>
                                            Manage Employees
                                        </h2>

                                        <p>
                                            This section will be used for the company admins in order to send invitations for
                                            company administrators and department administrators.
                                        </p>


                                        <div class="company-users-filters flex flex-center full-width margin-bottom-30 margin-top-50">

                                            <div class="profenda-filter-item flex flex-center">

                                                <label for="searchEmployee" class="filter-label">
                                                    Search Employee:
                                                </label>

                                                <div class="filter-field">

                                                    <input id="searchEmployee" name="employee_name" placeholder="Type a name or email">

                                                </div>

                                            </div>

                                            <div class="profenda-filter-item flex flex-center margin-left-auto no-margin-right">

                                                <label for="userRoleFilter" class="filter-label">
                                                    User Role:
                                                </label>

                                                <div class="filter-field">

                                                    <select id="userRoleFilter">
                                                        <option value="all">All</option>
                                                        <option value="shipping_company_department_admin">Department Admin</option>
                                                        <option value="shipping_company_employee">Employee</option>
                                                    </select>

                                                </div>

                                            </div>

                                        </div>

                                        <table id="departmentEmployeesTable">
                                            <thead>
                                            <tr>
                                                <th>
                                                    Name
                                                </th>
                                                <th>
                                                    Email
                                                </th>
                                                <th>
                                                    Role
                                                </th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php foreach( $companyObj->employees as $user_id ): $employee = new PlatformUser( $user_id );  ?>

                                                <tr>
                                                    <td>
                                                        <?php echo $employee->first_name . ' ' . $employee->last_name; ?>
                                                    </td>
                                                    <td>
                                                        <?php echo $employee->user_email; ?>
                                                    </td>
                                                    <td>
                                                        <?php

                                                        if( $employee->isShippingCompanyAdmin() ){
                                                            echo "Company Admin";
                                                        }
                                                        else if(  $employee->isDepartmentAdmin() ){
                                                            echo "Department Admin";
                                                        }
                                                        else {
                                                            echo "Employee";
                                                        }


                                                        ?>
                                                    </td>
                                                </tr>

                                            <?php endforeach; ?>
                                            </tbody>
                                        </table>

                                </div>

                            </div>

                            <div class="swiper-slide">

                                <div class="col s12 margin-top-50 swiper-no-swiping">

                                        <h2>
                                            Invitations
                                        </h2>

                                        <p>
                                            This section will be used for the company admins in order to send invitations for
                                            company administrators and department administrators.
                                        </p>

                                        <div class="company-users-filters flex flex-center full-width margin-bottom-30 margin-top-50">

                                            <?php

                                            echo $invitationForm->getSupplierInvitationForm($supplier_company_id);
//                                            getShippingInvitationForm
                                            ?>

                                        </div>

                                        <div class="company-users-filters flex-grow flex flex-center full-width margin-bottom-30 margin-top-50">

                                            <div class="profenda-filter-item flex flex-center">

                                                <label for="searchEmployeeInvitation" class="filter-label">
                                                    Search Employee:
                                                </label>

                                                <div class="filter-field">

                                                    <input id="searchEmployeeInvitation" name="employee_name" placeholder="Type a name or email">

                                                </div>

                                            </div>

                                            <div class="profenda-filter-item flex-grow flex flex-center margin-left-auto">

                                                <label for="statusFilterInvitation" class="filter-label">
                                                    Status:
                                                </label>

                                                <div class="filter-field">

                                                    <select id="statusFilterInvitation">
                                                        <option value="all">All</option>
                                                        <option value="expired">Expired</option>
                                                        <option value="accepted">Accepted</option>
                                                        <option value="pending">Pending</option>
                                                    </select>

                                                </div>

                                            </div>

                                            <div class="profenda-filter-item flex-grow flex flex-center no-margin-right">

                                                <label for="userRoleFilterInvitation" class="filter-label">
                                                    User Role:
                                                </label>

                                                <div class="filter-field">

                                                    <select id="userRoleFilterInvitation">
                                                        <option value="all">All</option>
                                                        <option value="shipping_company_admin">Company Admin</option>
                                                        <option value="shipping_company_department_admin">Department Admin</option>
                                                        <option value="shipping_company_employee">Employee</option>
                                                    </select>

                                                </div>

                                            </div>

                                            <div id="invitationTableDiv" class="full-width margin-top-50">

                                                <?php

                                                $invitationTable = new \ShippingAppointments\Service\Invitation\InvitationTableSupplier();

                                                echo $invitationTable->getSupplierCompanyInvitationTable($supplier_company_id);

                                                ?>

                                            </div>

                                        </div>

                                </div>

                            </div>

                        </div>

                    </div>

                <article>

            </div>

        </div>

    </div>


    </div> <!-- manage-company MAIN DIV -->

<?php
get_footer();


@extends('admin.layouts.app')

@section('title', 'Customers | RP Jewellers')

@section('content')

<div class="customers-page">

    <div class="page-header">

        <div>
            <span class="page-eyebrow">
                CUSTOMER MANAGEMENT
            </span>

            <h1>
                Customers
            </h1>

            <p>
                Manage your registered customers
            </p>
        </div>

    </div>


    <div class="customers-card">

        <div class="customers-card-header">

            <div class="card-title">

                <div class="title-icon">
                    <i class="fa-solid fa-users"></i>
                </div>

                <div>
                    <h2>
                        Customer List
                    </h2>

                    <span>
                        {{ $customers->count() }}
                        {{ $customers->count() == 1 ? 'customer' : 'customers' }}
                    </span>
                </div>

            </div>


            <div class="customer-search">

                <i class="fa-solid fa-magnifying-glass"></i>

                <input
                    type="text"
                    id="customerSearch"
                    placeholder="Search customers..."
                    autocomplete="off"
                >

            </div>

        </div>


        @if($customers->count() > 0)

            <div class="customers-table-wrapper">

                <table class="customers-table">

                    <thead>

                        <tr>

                            <th>#</th>

                            <th>
                                CUSTOMER
                            </th>

                            <th>
                                EMAIL
                            </th>

                            <th>
                                REGISTERED
                            </th>

                            <th>
                                STATUS
                            </th>

                            <th>
                                ACTION
                            </th>

                        </tr>

                    </thead>


                    <tbody id="customerTableBody">

                        @foreach($customers as $customer)

                            <tr class="customer-row">

                                <td class="customer-number">
                                    {{ $loop->iteration }}
                                </td>


                                <td>

                                    <div class="customer-info">

                                        <div class="customer-avatar">

                                            {{ strtoupper(substr($customer->name, 0, 1)) }}

                                        </div>


                                        <div class="customer-details">

                                            <strong>
                                                {{ $customer->name }}
                                            </strong>

                                            <span>
                                                Customer
                                            </span>

                                        </div>

                                    </div>

                                </td>


                                <td>

                                    <div class="email-info">

                                        <i class="fa-regular fa-envelope"></i>

                                        <span>
                                            {{ $customer->email }}
                                        </span>

                                    </div>

                                </td>


                                <td>

                                    <div class="date-info">

                                        <strong>
                                            {{ $customer->created_at->format('d M Y') }}
                                        </strong>

                                        <span>
                                            {{ $customer->created_at->format('h:i A') }}
                                        </span>

                                    </div>

                                </td>


                                <td>

                                    <span class="status-badge">

                                        <span class="status-dot"></span>

                                        Active

                                    </span>

                                </td>


                                <td>

                                    <a
                                        href="{{ route('admin.customers.show', $customer->id) }}"
                                        class="view-button"
                                    >

                                        <i class="fa-regular fa-eye"></i>

                                        View

                                    </a>

                                </td>

                            </tr>

                        @endforeach

                    </tbody>

                </table>

            </div>


            <div
                class="no-search-result"
                id="noSearchResult"
                style="display: none;"
            >

                <div class="empty-icon">

                    <i class="fa-solid fa-user-slash"></i>

                </div>

                <h3>
                    No Customer Found
                </h3>

                <p>
                    Try searching with another name or email.
                </p>

            </div>

        @else

            <div class="empty-customers">

                <div class="empty-icon">

                    <i class="fa-solid fa-users"></i>

                </div>

                <h3>
                    No Customers Found
                </h3>

                <p>
                    There are no registered customers yet.
                </p>

            </div>

        @endif

    </div>


    <div class="customer-info-banner">

        <div class="banner-icon">

            <i class="fa-solid fa-shield-halved"></i>

        </div>

        <div>

            <strong>
                Customer Information
            </strong>

            <p>
                Customer details are securely stored and can only be accessed by authorized administrators.
            </p>

        </div>

    </div>

</div>


<script>

document.addEventListener('DOMContentLoaded', function () {

    const searchInput = document.getElementById('customerSearch');

    const rows = document.querySelectorAll('.customer-row');

    const noResult = document.getElementById('noSearchResult');


    if (!searchInput) {
        return;
    }


    searchInput.addEventListener('input', function () {

        const searchValue = this.value.toLowerCase().trim();

        let visibleRows = 0;


        rows.forEach(function (row) {

            const rowText = row.textContent.toLowerCase();


            if (rowText.includes(searchValue)) {

                row.style.display = '';

                visibleRows++;

            } else {

                row.style.display = 'none';

            }

        });


        if (noResult) {

            noResult.style.display =
                visibleRows === 0 ? 'flex' : 'none';

        }

    });

});

</script>

@endsection
@extends('layouts.app')

@section('content')
    @if (session('status'))
        <div class="alert alert-success" role="alert">
            {{ session('status') }}
        </div>
    @endif

    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <div class="card">
                    <div class="card-header">
                        <div class="d-inline-block" style="width: 50%">
                            <input type="text" name="search" placeholder="search" class="form-control">
                        </div>
                        <span class="float-end">
                            <button class="btn btn-primary" id="ask-question-btn">
                                Ask a question
                            </button>
                        </span>
                    </div>

                    <table class="table align-middle mb-0 bg-white">
                        <thead class="bg-light">
                            <tr>
                                <th>Name</th>
                                <th>Title</th>
                                <th>Status</th>
                                <th>Date</th>
                                <th>Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach ($tickets as $ticket)
                                <tr>
                                    <td>
                                        <p class="fw-normal mb-1">{{ $ticket->owner->name }}</p>
                                        <p class="text-muted mb-0">{{ $ticket->owner->email }}</p>
                                    </td>
                                    <td>
                                        <div class="d-flex align-items-center">
                                            <div class="ms-3">
                                                <p class="fw-bold mb-1">{{ $ticket->title }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td>
                                        @if (auth()->user()->user_type === 'support')
                                            <span
                                                class="{{ $ticket->statusBadge() }} rounded-pill d-inline">{{ $ticket->status }}
                                            </span>
                                        @else
                                            <form method="post" action="ticket/{{ $ticket->id }}">
                                                @csrf
                                                @method('put')
                                                <select name="status" class="form-select">
                                                    <option {{ $ticket->status == 'In progress' ? 'selected' : '' }}
                                                        value="1">In progress</option>
                                                    <option {{ $ticket->status == 'Answered' ? 'selected' : '' }}
                                                        value="2">
                                                        Answered</option>
                                                    <option {{ $ticket->status == 'Not answered' ? 'selected' : '' }}
                                                        value="3">Not
                                                        answered</option>
                                                    <option {{ $ticket->status == 'Spam' ? 'selected' : '' }} value="4">
                                                        Spam </option>
                                                </select>
                                            </form>
                                        @endif
                                    </td>
                                    <td>{{ $ticket->updated_at }}</td>
                                    <td>
                                        <button type="button" class="btn btn-link btn-sm btn-rounded">
                                            <a href="/chatify">
                                                View chat
                                            </a>
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>


    <script>
        const askQuestionBtn = document.getElementById('ask-question-btn');
        askQuestionBtn.addEventListener('click', () => {
            Swal.fire({
                title: 'Ask a question',
                html: `
                <form action="{{ url('/ticket') }}" method='post'>
                    @csrf
                    <div class='input-group '>
                        <input name='question' class='form-control' placeholder="Ask a question" required />
                    </div>

                    <div class='mt-3'>
                        <button class='btn btn-primary'>Submit</button>
                    </div>
                </form>
                `,
                showCloseButton: false,
                showCancelButton: false,
                showConfirmButton: false,
                focusConfirm: false,
            })
        })
    </script>

    <script>
        const search = document.querySelector('input[name=search]');

        document.addEventListener('DOMContentLoaded', () => {
            search.addEventListener('keyup', () => {
                const searchValue = search.value.toLowerCase();
                const tableRows = document.querySelectorAll('table tbody tr');

                tableRows.forEach(row => {
                    const rowText = row.textContent.toLowerCase();
                    if (rowText.indexOf(searchValue) === -1) {
                        row.style.display = 'none';
                    } else {
                        row.style.display = 'table-row';
                    }
                })
            })
        })
    </script>

    <script>
        const selects = document.querySelectorAll('select');
        console.log(selects);
        selects.forEach((select) => {
            select.addEventListener('change', () => {
                const form = select.parentElement;
                form.submit();
            })
        })
    </script>
@endsection

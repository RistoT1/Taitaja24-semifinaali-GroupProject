@extends('layouts.app')

@section('title', 'Profiili')

@section('content')
    <main>
        <div class="profile-wrapper">
            <div class="profile-container">
                <div class="user-info-section">
                    <div class="welcome-title">
                        <h1>Tervetuloa, <span class="username">{{ $user->Nimi }}</span></h1>
                    </div>

                    <div class="user-info">
                        <h2>Tiedot:</h2>
                        @if (session('status'))
                            <div class="alert alert-success">
                                {{ session('status') }}
                            </div>
                        @endif

                        <!-- NAME -->
                        <div class="info-item" data-field="Nimi">
                            <p>
                                <strong>Nimi:</strong>
                                <span class="display-value">{{ $user->Nimi }}</span>
                                <input class="edit-input" type="text" value="{{ $user->Nimi }}" style="display: none;">
                            </p>
                            <span>
                                <i class="fa-regular fa-pen-to-square edit-btn"></i>
                                <button class="save-btn" style="display:none;">Tallenna</button>
                            </span>
                        </div>

                        <!-- PHONE -->
                        <div class="info-item" data-field="Puhelin">
                            <p>
                                <strong>Puhelin:</strong>
                                <span class="display-value">{{ $user->Puhelin }}</span>
                                <input class="edit-input" type="text" value="{{ $user->Puhelin }}" style="display: none;">
                            </p>
                            <span>
                                <i class="fa-regular fa-pen-to-square edit-btn"></i>
                                <button class="save-btn" style="display:none;">Tallenna</button>
                            </span>
                        </div>

                        <!-- ADDRESS -->
                        <div class="info-list" data-field="Osoitetiedot">
                            <div class="address-container">
                                <p class="address-title">
                                    <strong>Toimitustiedot:</strong>
                                    <span>
                                        <i class="fa-regular fa-pen-to-square edit-btn-list"></i>
                                        <button class="save-btn-osoite" style="display:none;">Tallenna</button>
                                    </span>
                                </p>
                                <span class="display-value">
                                    <ol class="display-value-ol">
                                        <li>Osoite: <span
                                                class="display-value">{{ $osoite->Osoite ?? 'Ei asetettu' }}</span>
                                            <input class="edit-input" type="text" name="Osoite" data-field="Osoite"
                                                value="{{ $osoite->Osoite ?? '' }}" style="display: none;">
                                        </li>
                                        <li>Postinumero: <span
                                                class="display-value">{{ $osoite->Postinumero ?? 'Ei asetettu' }}</span>
                                            <input class="edit-input" type="text" name="Postinumero"
                                                data-field="Postinumero" value="{{ $osoite->Postinumero ?? '' }}"
                                                style="display: none;">
                                        </li>
                                        <li>Kaupunki: <span
                                                class="display-value">{{ $osoite->Kaupunki ?? 'Ei asetettu' }}</span>
                                            <input class="edit-input" type="text" name="Kaupunki" data-field="Kaupunki"
                                                value="{{ $osoite->Kaupunki ?? '' }}" style="display: none;">
                                        </li>
                                    </ol>
                                </span>
                            </div>
                        </div>

                        <!-- EMAIL -->
                        <div class="info-secure-item" data-field="Sähköposti">
                            <p>
                                <strong>Sähköposti:</strong>
                                <span class="display-value">{{ $user->Sähköposti }}</span>
                                <span class="display-value"> varmistettu: {{ $user->email_verified_at }}</span>
                            </p>
                            <form action="{{ route('email.change.request') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit"
                                    style="background:none;border:none;color:#007bff;cursor:pointer;padding:0;">
                                    Lähetä nollaus
                                </button>
                            </form>
                        </div>

                        <!-- PASSWORD -->
                        <div class="info-secure-item" data-field="Salasana">
                            <p>
                                <strong>Salasana:</strong>
                                <span class="display-value">••••••••••</span>
                            </p>
                            <form action="{{ route('password.reset.request') }}" method="POST" style="display:inline;">
                                @csrf
                                <button type="submit"
                                    style="background:none;border:none;color:#007bff;cursor:pointer;padding:0;">
                                    Lähetä nollaus
                                </button>
                            </form>
                        </div>
                    </div>
                </div>

                <div class="save-changes" style="display: none;">
                    <h2>Tallenna muutokset</h2>
                    <div class="changes-button-container">
                        <button class="cancel-btn">peruuta</button>
                        <button class="save-all-btn">tallenna</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let hasChanges = {};
            const saveChangesContainer = document.querySelector(".save-changes");
            const saveAllBtn = document.querySelector(".save-all-btn");
            const cancelAllBtn = document.querySelector(".cancel-btn");

            const editListBtn = document.querySelector('.edit-btn-list');
            const addressList = document.querySelector('.display-value-ol');
            const addressListSave = document.querySelector('.save-btn-osoite');

            const listItems = addressList.querySelectorAll('li');
            let originalAddress = {};

            // Store original address values
            listItems.forEach(item => {
                const input = item.querySelector('input.edit-input');
                if (input) {
                    const field = input.dataset.field;
                    originalAddress[field] = input.value;
                }
            });

            // Edit address list
            editListBtn.addEventListener('click', () => {
                listItems.forEach(item => {
                    const displaySpan = item.querySelector('span.display-value');
                    const input = item.querySelector('input.edit-input');

                    if (displaySpan && input) {
                        displaySpan.style.display = 'none';
                        input.style.display = 'inline';
                    }
                });
                addressListSave.style.display = "inline-block";
                editListBtn.style.display = 'none';
            });

            // Save address list
            addressListSave.addEventListener('click', () => {
                listItems.forEach(item => {
                    const displaySpan = item.querySelector('span.display-value');
                    const input = item.querySelector('input.edit-input');

                    if (input && displaySpan) {
                        const field = input.dataset.field;

                        // Check if value changed
                        if (input.value.trim() !== originalAddress[field]) {
                            displaySpan.textContent = input.value.trim() || 'Ei asetettu';
                            hasChanges[field] = input.value.trim();
                            console.log(`Updated ${field}: ${input.value.trim()}`);
                        }

                        displaySpan.style.display = 'inline';
                        input.style.display = 'none';
                    }
                });

                editListBtn.style.display = 'inline-block';
                addressListSave.style.display = "none";
                saveChangesContainer.style.display = Object.keys(hasChanges).length > 0 ? "flex" : "none";
            });

            // Update individual fields
            document.querySelectorAll(".info-item").forEach(item => {
                const field = item.dataset.field;
                const editBtn = item.querySelector(".edit-btn");
                const saveBtn = item.querySelector(".save-btn");
                const displayValue = item.querySelector(".display-value");
                const input = item.querySelector(".edit-input");
                const originalValue = displayValue.textContent;

                item.dataset.originalValue = originalValue;

                editBtn.addEventListener("click", () => {
                    displayValue.style.display = "none";
                    input.style.display = "inline-block";
                    saveBtn.style.display = "inline-block";
                    editBtn.style.display = "none";
                });

                saveBtn.addEventListener("click", () => {
                    if (input.value.trim() !== "" && input.value.trim() !== originalValue) {
                        hasChanges[field] = input.value.trim();
                    } else {
                        delete hasChanges[field];
                    }
                    displayValue.textContent = input.value;
                    displayValue.style.display = "inline";
                    input.style.display = "none";
                    saveBtn.style.display = "none";
                    editBtn.style.display = "inline-block";

                    saveChangesContainer.style.display = Object.keys(hasChanges).length > 0 ? "flex" : "none";
                });
            });

            // Save all changes
            saveAllBtn.addEventListener("click", async () => {
                const userFields = ['Nimi', 'Puhelin'];
                const addressFields = ['Osoite', 'Postinumero', 'Kaupunki'];

                const changedUserFields = Object.keys(hasChanges).filter(key => userFields.includes(key));
                const changedAddressFields = Object.keys(hasChanges).filter(key => addressFields.includes(key));

                try {
                    // Save user fields
                    if (changedUserFields.length > 0) {
                        const userData = {};
                        changedUserFields.forEach(field => {
                            userData[field] = hasChanges[field];
                        });

                        const userResponse = await fetch('/me/update', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(userData)
                        });

                        if (!userResponse.ok) {
                            throw new Error('Failed to update user data');
                        }
                    }

                    // Save address fields
                    if (changedAddressFields.length > 0) {
                        const addressData = {};
                        changedAddressFields.forEach(field => {
                            addressData[field] = hasChanges[field];
                        });

                        const addressResponse = await fetch('/me/update/address', {
                            method: 'POST',
                            headers: {
                                'Content-Type': 'application/json',
                                'Accept': 'application/json',
                                'X-CSRF-TOKEN': '{{ csrf_token() }}'
                            },
                            body: JSON.stringify(addressData)
                        });
                        console.log(addressResponse);
                        if (!addressResponse.ok) {
                            const errorData = await addressResponse.json();

                            // Laravel validation error
                            if (addressResponse.status === 422) {
                                console.log('Validation errors:', errorData.errors);

                                // Example: show first Postinumero error
                                if (errorData.errors?.Postinumero) {
                                    alert(errorData.errors.Postinumero[0]);
                                }

                                return;
                            }

                            throw new Error('Failed to update address');
                        }
                    }

                    alert("Muutokset tallennettu onnistuneesti!");

                    // Update original values
                    document.querySelectorAll(".info-item").forEach(item => {
                        const displayValue = item.querySelector(".display-value");
                        item.dataset.originalValue = displayValue.textContent;
                    });

                    listItems.forEach(item => {
                        const input = item.querySelector("input.edit-input");
                        if (input) {
                            const field = input.dataset.field;
                            originalAddress[field] = input.value.trim();
                        }
                    });

                    hasChanges = {};
                    saveChangesContainer.style.display = "none";

                } catch (error) {
                    console.error('Error:', error);
                    alert("Virhe tallennuksessa!");
                }
            });

            // Cancel all changes
            cancelAllBtn.addEventListener("click", () => {
                // Revert user fields
                document.querySelectorAll(".info-item").forEach(item => {
                    const displayValue = item.querySelector(".display-value");
                    const input = item.querySelector(".edit-input");
                    const saveBtn = item.querySelector(".save-btn");
                    const editBtn = item.querySelector(".edit-btn");
                    const originalValue = item.dataset.originalValue;

                    displayValue.textContent = originalValue;
                    input.value = originalValue;
                    input.style.display = "none";
                    saveBtn.style.display = "none";
                    displayValue.style.display = "inline";
                    editBtn.style.display = "inline-block";
                });

                // Revert address fields
                listItems.forEach(item => {
                    const displaySpan = item.querySelector("span.display-value");
                    const input = item.querySelector("input.edit-input");

                    if (input && displaySpan) {
                        const field = input.dataset.field;
                        const originalValue = originalAddress[field];

                        displaySpan.textContent = originalValue || 'Ei asetettu';
                        input.value = originalValue || '';
                        displaySpan.style.display = "inline";
                        input.style.display = "none";
                    }
                });

                editListBtn.style.display = 'inline-block';
                addressListSave.style.display = "none";
                hasChanges = {};
                saveChangesContainer.style.display = "none";
            });
        });
    </script>
@endsection
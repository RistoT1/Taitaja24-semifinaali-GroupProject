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

                        <!-- EMAIL -->
                        <div class="info-secure-item" data-field="Sähköposti">
                            <p>
                                <strong>Sähköposti:</strong>
                                <span class="display-value">{{ $user->Sähköposti }}</span>
                                <span class="display-value"> varmistettu: {{ $user->email_verified_at}}</span>
                            </p>
                            <a href="">Lähetä nollaus</a>
                        </div>

                        <div class="info-secure-item" data-field="Sähköposti">
                            <p>
                                <strong>Salasana:</strong>
                                <span class="display-value">••••••••••</span>
                            </p>
                            <a href="">Lähetä nollaus</a>
                        </div>
                    </div>
                </div>
                <div class="save-changes">
                    <h2>Tallenna muutokset</h2>
                    <div class="changes-button-container">
                        <button class="cancel-btn">peruuta</button>
                        <button>tallenna</button>
                    </div>
                </div>
            </div>
        </div>
    </main>

    {{-- JS --}}
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            let hasChanges = {};
            const saveChanges = document.querySelector(".save-changes");
            saveChanges.addEventListener("click", async () => {
                console.log("Saving changes:", hasChanges);
                
                const response = await fetch('/me/update', {
                    method: 'POST',
                    headers: {
                        'Content-Type': 'application/json',
                        'X-CSRF-TOKEN': '{{ csrf_token() }}'
                    },
                    body: JSON.stringify(hasChanges)
                });

                if(response.ok) {
                    alert("Changes saved successfully!");
                    hasChanges = {};
                    saveChanges.style.display = "none";
                } else {
                    alert("Error saving changes.");
                }

            });
            document.querySelectorAll(".info-item").forEach(item => {

                const field = item.dataset.field;
                const editBtn = item.querySelector(".edit-btn");
                const saveBtn = item.querySelector(".save-btn");
                const displayValue = item.querySelector(".display-value");
                const input = item.querySelector(".edit-input");
                const originalValue = displayValue.textContent;

                // When clicking the pen → show input
                editBtn.addEventListener("click", () => {
                    displayValue.style.display = "none";
                    input.style.display = "inline-block";
                    saveBtn.style.display = "inline-block";
                    editBtn.style.display = "none";
                });

                // When clicking OK → update display + hide input again
                saveBtn.addEventListener("click", () => {


                    if (input.value.trim() !== "" && input.value.trim() !== displayValue.textContent) {
                        if (input.value.trim() !== originalValue) {
                            hasChanges[field] = input.value;
                        }
                        else {
                            delete hasChanges[field];
                        }
                        displayValue.textContent = input.value;
                    }



                    console.log("Has changes:", hasChanges);
                    displayValue.style.display = "inline";
                    input.style.display = "none";
                    saveBtn.style.display = "none";
                    editBtn.style.display = "inline-block";
                    saveChanges.style.display = Object.keys(hasChanges).length > 0 ? "flex" : "none";
                });
            });
        });
    </script>

@endsection
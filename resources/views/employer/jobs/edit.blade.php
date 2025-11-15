@extends('employer.layouts.app')

@section('content')
    <div class="max-w-4xl mx-auto py-10">
        <h2 class="text-2xl font-bold mb-6">Edit Job Post</h2>

        <form action="{{ route('jobs.update', $job->id) }}" method="POST" enctype="multipart/form-data" class="space-y-6">
            @csrf
            @method('PUT')

            {{-- Title --}}
            <div>
                <label class="block mb-1 font-semibold">Job Title</label>
                <input type="text" name="title" value="{{ old('title', $job->title) }}"
                    class="w-full border rounded px-3 py-2 dark:bg-slate-700 dark:text-white">
                @error('title')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Description --}}
            <div>
                <label class="block mb-1 font-semibold">Description</label>
                <textarea name="description" rows="5" class="w-full border rounded px-3 py-2 dark:bg-slate-700 dark:text-white">{{ old('description', $job->description) }}</textarea>
                @error('description')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            {{-- Responsibilities --}}
            <div>
                <label class="block mb-1 font-semibold">Responsibilities</label>
                <textarea name="responsibilities" rows="4"
                    class="w-full border rounded px-3 py-2 dark:bg-slate-700 dark:text-white">{{ old('responsibilities', $job->responsibilities) }}</textarea>
                @error('responsibilities')
                    <p class="text-red-500 text-sm">{{ $message }}</p>
                @enderror
            </div>

            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">

                {{-- Category --}}
                <div>
                    <label class="block mb-1 font-semibold">Category</label>
                    <select name="category_id" class="w-full border rounded px-3 py-2 dark:bg-slate-700 dark:text-white">
                        <option value="">-- Select Category --</option>

                        @foreach ($categories as $cat)
                            <option value="{{ $cat->id }}"
                                {{ old('category_id', $job->category_id) == $cat->id ? 'selected' : '' }}>
                                {{ $cat->name }}
                            </option>
                        @endforeach
                    </select>
                    @error('category_id')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Location --}}
                <div>
                    <label class="block mb-1 font-semibold">Location</label>
                    <input type="text" name="location" value="{{ old('location', $job->location) }}"
                        class="w-full border rounded px-3 py-2 dark:bg-slate-700 dark:text-white">
                    @error('location')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Work Type --}}
                <div>
                    <label class="block mb-1 font-semibold">Work Type</label>
                    <select name="work_type" class="w-full border rounded px-3 py-2 dark:bg-slate-700 dark:text-white">
                        <option value="remote" {{ old('work_type', $job->work_type) == 'remote' ? 'selected' : '' }}>Remote
                        </option>
                        <option value="on-site" {{ old('work_type', $job->work_type) == 'on-site' ? 'selected' : '' }}>
                            On-site
                        </option>
                        <option value="hybrid" {{ old('work_type', $job->work_type) == 'hybrid' ? 'selected' : '' }}>Hybrid
                        </option>
                    </select>
                    @error('work_type')
                        <p class="text-red-500 text-sm">{{ $message }}</p>
                    @enderror
                </div>

                {{-- Application Deadline --}}
                <div>
                    <label class="block mb-1 font-semibold">Application Deadline</label>
                    <input type="date" name="application_deadline"
                        value="{{ old('application_deadline', $job->application_deadline) }}"
                        class="w-full border rounded px-3 py-2 dark:bg-slate-700 dark:text-white">
                </div>
            </div>



            {{-- Skills --}}
            <div x-data="dropdownTagsSkills({{ json_encode(old('skills', $job->skills ?? [])) }})" class="mb-4 relative">
                <label class="block font-semibold text-gray-700 dark:text-gray-200 mb-1">Skills</label>

                <!-- Selected Items -->
                <div class="flex flex-wrap gap-2 mt-2 min-h-[40px]">
                    <template x-for="(tag, index) in selected" :key="index">
                        <span
                            class="flex items-center gap-1 bg-blue-600 text-white px-3 py-1 rounded-full shadow-sm hover:bg-blue-700 transition">
                            <span x-text="tag"></span>
                            <button @click="removeSkill(index)" type="button"
                                class="text-white hover:text-gray-200 font-bold">×</button>
                        </span>
                    </template>
                </div>

                <!-- Hidden Inputs -->
                <template x-for="tag in selected">
                    <input type="hidden" name="skills[]" :value="tag">
                </template>

                <!-- Dropdown Button -->
                <button type="button" @click="open = !open"
                    class="mt-2 w-full px-4 py-2 border rounded-md bg-white dark:bg-slate-700 text-gray-800 dark:text-white shadow-sm hover:ring-1 hover:ring-blue-500 transition flex justify-between items-center">
                    <span>Select Skills</span>
                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" x-transition @click.outside="open = false"
                    class="absolute z-50 mt-1 w-full border rounded-md bg-white dark:bg-slate-800 shadow-lg max-h-60 overflow-y-auto">
                    <template x-for="skill in allSkills">
                        <div @click="addSkill(skill)"
                            class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-slate-700 cursor-pointer transition rounded-md"
                            x-text="skill"></div>
                    </template>
                    <template x-if="allSkills.length === 0">
                        <div class="px-4 py-2 text-gray-400">No skills available</div>
                    </template>
                </div>
            </div>



            {{-- Qualifications --}}
            <div x-data="dropdownTagsQualifications({{ json_encode(old('qualifications', $job->qualifications ?? [])) }})" class="mb-4 relative">
                <label class="block font-semibold text-gray-700 dark:text-gray-200 mb-1">Qualifications</label>

                <!-- Selected Items -->
                <div class="flex flex-wrap gap-2 mt-2 min-h-[40px]">
                    <template x-for="(tag, index) in selected" :key="index">
                        <span
                            class="flex items-center gap-1 bg-green-600 text-white px-3 py-1 rounded-full shadow-sm hover:bg-green-700 transition">
                            <span x-text="tag"></span>
                            <button @click="removeTag(index)" type="button"
                                class="text-white hover:text-gray-200 font-bold">×</button>
                        </span>
                    </template>
                </div>

                <!-- Hidden Inputs -->
                <template x-for="tag in selected">
                    <input type="hidden" name="qualifications[]" :value="tag">
                </template>

                <!-- Dropdown Button -->
                <button type="button" @click="open = !open"
                    class="mt-2 w-full px-4 py-2 border rounded-md bg-white dark:bg-slate-700 text-gray-800 dark:text-white shadow-sm hover:ring-1 hover:ring-green-500 transition flex justify-between items-center">
                    <span>Select Qualifications</span>
                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" x-transition @click.outside="open = false"
                    class="absolute z-50 mt-1 w-full border rounded-md bg-white dark:bg-slate-800 shadow-lg max-h-60 overflow-y-auto">
                    <template x-for="option in allOptions">
                        <div @click="addTag(option)"
                            class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-slate-700 cursor-pointer transition rounded-md"
                            x-text="option"></div>
                    </template>
                </div>
            </div>

            {{-- Technologies --}}
            <div x-data="dropdownTagsTech({{ json_encode(old('technologies', $job->technologies ?? [])) }})" class="mb-4 relative">
                <label class="block font-semibold text-gray-700 dark:text-gray-200 mb-1">Technologies</label>

                <!-- Selected Items -->
                <div class="flex flex-wrap gap-2 mt-2 min-h-[40px]">
                    <template x-for="(tag, index) in selected" :key="index">
                        <span
                            class="flex items-center gap-1 bg-purple-600 text-white px-3 py-1 rounded-full shadow-sm hover:bg-purple-700 transition">
                            <span x-text="tag"></span>
                            <button @click="removeTag(index)" type="button"
                                class="text-white hover:text-gray-200 font-bold">×</button>
                        </span>
                    </template>
                </div>

                <!-- Hidden Inputs -->
                <template x-for="tag in selected">
                    <input type="hidden" name="technologies[]" :value="tag">
                </template>

                <!-- Dropdown Button -->
                <button type="button" @click="open = !open"
                    class="mt-2 w-full px-4 py-2 border rounded-md bg-white dark:bg-slate-700 text-gray-800 dark:text-white shadow-sm hover:ring-1 hover:ring-purple-500 transition flex justify-between items-center">
                    <span>Select Technologies</span>
                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" x-transition @click.outside="open = false"
                    class="absolute z-50 mt-1 w-full border rounded-md bg-white dark:bg-slate-800 shadow-lg max-h-60 overflow-y-auto">
                    <template x-for="option in allOptions">
                        <div @click="addTag(option)"
                            class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-slate-700 cursor-pointer transition rounded-md"
                            x-text="option"></div>
                    </template>
                </div>
            </div>

            {{-- Benefits --}}
            <div x-data="dropdownTagsBenefits({{ json_encode(old('benefits', $job->benefits ?? [])) }})" class="mb-4 relative">
                <label class="block font-semibold text-gray-700 dark:text-gray-200 mb-1">Benefits</label>

                <!-- Selected Items -->
                <div class="flex flex-wrap gap-2 mt-2 min-h-[40px]">
                    <template x-for="(tag, index) in selected" :key="index">
                        <span
                            class="flex items-center gap-1 bg-orange-600 text-white px-3 py-1 rounded-full shadow-sm hover:bg-orange-700 transition">
                            <span x-text="tag"></span>
                            <button @click="removeTag(index)" type="button"
                                class="text-white hover:text-gray-200 font-bold">×</button>
                        </span>
                    </template>
                </div>

                <!-- Hidden Inputs -->
                <template x-for="tag in selected">
                    <input type="hidden" name="benefits[]" :value="tag">
                </template>

                <!-- Dropdown Button -->
                <button type="button" @click="open = !open"
                    class="mt-2 w-full px-4 py-2 border rounded-md bg-white dark:bg-slate-700 text-gray-800 dark:text-white shadow-sm hover:ring-1 hover:ring-orange-500 transition flex justify-between items-center">
                    <span>Select Benefits</span>
                    <svg :class="{ 'rotate-180': open }" class="w-4 h-4 transition-transform" fill="none"
                        stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19 9l-7 7-7-7" />
                    </svg>
                </button>

                <!-- Dropdown Menu -->
                <div x-show="open" x-transition @click.outside="open = false"
                    class="absolute z-50 mt-1 w-full border rounded-md bg-white dark:bg-slate-800 shadow-lg max-h-60 overflow-y-auto">
                    <template x-for="option in allOptions">
                        <div @click="addTag(option)"
                            class="px-4 py-2 hover:bg-gray-100 dark:hover:bg-slate-700 cursor-pointer transition rounded-md"
                            x-text="option"></div>
                    </template>
                </div>
            </div>



            {{-- Salary --}}
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <label class="block mb-1 font-semibold">Salary Min</label>
                    <input type="number" step="0.01" name="salary_min"
                        value="{{ old('salary_min', $job->salary_min) }}"
                        class="w-full border rounded px-3 py-2 dark:bg-slate-700 dark:text-white">
                </div>

                <div>
                    <label class="block mb-1 font-semibold">Salary Max</label>
                    <input type="number" step="0.01" name="salary_max"
                        value="{{ old('salary_max', $job->salary_max) }}"
                        class="w-full border rounded px-3 py-2 dark:bg-slate-700 dark:text-white">
                </div>
            </div>




            {{-- Branding Image --}}
<div x-data="imagePreview('{{ $job->branding_image ? asset('storage/' . $job->branding_image) : '' }}')" class="space-y-2">
    <label class="block font-semibold text-gray-700 dark:text-gray-300 mb-1">Branding Image</label>

    <div class="flex items-center gap-4">
        <!-- Image Preview Box -->
        <div class="w-24 h-24 bg-gray-50 dark:bg-slate-700 rounded-md border flex items-center justify-center overflow-hidden">
            <template x-if="preview">
                <img :src="preview" alt="Preview" class="object-cover w-full h-full">
            </template>
            <template x-if="!preview">
                <svg class="h-8 w-8 text-gray-300" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 16V4m10 12V8M7 20h10" />
                </svg>
            </template>
        </div>

        <!-- File Input & Actions -->
        <div class="flex-1">
            <input id="branding_image" name="branding_image" type="file" accept="image/*"
                @change="onFileChange($event)"
                class="block w-full text-sm text-gray-700 dark:text-gray-200 rounded border px-3 py-2 dark:bg-slate-700 dark:border-slate-600">
            <p class="text-xs text-gray-400 dark:text-gray-400 mt-1">Recommended: PNG/JPG up to 2MB.</p>

            <div class="mt-2 flex gap-2">
                <button type="button" @click="remove()"
                    class="px-3 py-1 bg-red-50 text-red-700 rounded text-sm hidden" x-ref="removeBtn">Remove</button>
            </div>

            @error('branding_image')
                <p class="mt-1 text-sm text-red-600">{{ $message }}</p>
            @enderror
        </div>
    </div>
</div>


            {{-- Submit --}}
            <div class="text-right">
                <button class="px-6 py-2 bg-orange-600 text-white rounded hover:bg-orange-700">
                    Update Job
                </button>
            </div>

        </form>
    </div>

    {{-- Alpine.js Tags Handler --}}
    <script>
        function tagsHandler(initialTags, fieldName) {
            return {
                tags: initialTags || [],
                input: "",
                add() {
                    if (this.input.trim() !== "") {
                        this.tags.push(this.input.trim());
                        this.input = "";
                    }
                },
                remove(index) {
                    this.tags.splice(index, 1);
                }
            };
        }
        // skills
        function dropdownTagsSkills(initial = []) {
            return {
                open: false,
                selected: Array.isArray(initial) ? initial : [],
                allSkills: [
                    'Teamwork',
                    'Leadership',
                    'Problem Solving',
                    'Communication',
                    'Time Management',
                    'Adaptability',
                    'Critical Thinking',
                    'Creativity',
                    'Conflict Resolution',
                    'Collaboration',
                    'Decision Making',
                    'Emotional Intelligence',
                    'Organization',
                    'Presentation Skills',
                    'Negotiation',
                    'Motivation',
                    'Flexibility',
                    'Work Ethic'
                ],
                addSkill(skill) {
                    if (!this.selected.includes(skill)) {
                        this.selected.push(skill);
                    }
                    this.open = false; // أغلق القائمة بعد الاختيار
                },
                removeSkill(index) {
                    this.selected.splice(index, 1);
                }
            }
        }
        function imagePreview(initial = '') {
    return {
        preview: initial || null,
        onFileChange(event) {
            const file = event.target.files[0];
            if (!file) return;
            const reader = new FileReader();
            reader.onload = e => {
                this.preview = e.target.result;
                this.$refs.removeBtn.classList.remove('hidden');
            };
            reader.readAsDataURL(file);
        },
        remove() {
            this.preview = null;
            this.$refs.removeBtn.classList.add('hidden');
            this.$el.querySelector('input[type="file"]').value = '';
        }
    }
}

        //location
        function dropdownAutocomplete() {
            return {
                query: '',
                open: false,
                locations: [
                    'Cairo, Egypt',
                    'Giza, Egypt',
                    'Alexandria, Egypt',
                    'Dubai, UAE',
                    'Riyadh, Saudi Arabia',
                    'Jeddah, Saudi Arabia',
                    'Amman, Jordan',
                    'London, UK',
                    'New York, USA',
                    'Berlin, Germany',
                    'Remote',
                    'Hybrid'
                ],
                get filteredLocations() {
                    if (this.query === '') return this.locations;
                    return this.locations.filter(loc =>
                        loc.toLowerCase().includes(this.query.toLowerCase())
                    );
                },
                select(item) {
                    this.query = item;
                    this.open = false;
                }
            };
        }
        // qualifications
        function dropdownTagsQualifications(initial = []) {
            return {
                open: false,
                selected: initial,
                allOptions: ['High School', 'Bachelor', 'Master', '1 year', '3 years', '5 years'],
                addTag(tag) {
                    if (!this.selected.includes(tag)) {
                        this.selected.push(tag);
                    }
                    this.open = false;
                },
                removeTag(index) {
                    this.selected.splice(index, 1);
                }
            }
        }

        //tech
        function dropdownTagsTech(initial = []) {
            return {
                open: false,
                selected: initial,
                allOptions: ['Laravel', 'PHP', 'MySQL', 'React', 'Vue.js', 'Angular',
                    'JavaScript', 'TypeScript', 'HTML', 'CSS', 'Bootstrap',
                    'TailwindCSS', 'REST API', 'Git', 'Docker', 'AWS', 'Node.js'
                ],
                addTag(tag) {
                    if (!this.selected.includes(tag)) {
                        this.selected.push(tag);
                    }
                    this.open = false;
                },
                removeTag(index) {
                    this.selected.splice(index, 1);
                }
            }
        }
        //benfits
        function dropdownTagsBenefits(initial = []) {
            return {
                open: false,
                selected: Array.isArray(initial) ? initial : [],
                allOptions: [
                    'Health Insurance',
                    'Remote Allowance',
                    'Paid Time Off',
                    'Flexible Hours',
                    'Performance Bonus',
                    'Retirement Plan',
                    'Training & Development',
                    'Company Laptop',
                    'Team Outings',
                    'Gym Membership'
                ],
                addTag(tag) {
                    if (!this.selected.includes(tag)) {
                        this.selected.push(tag);
                    }
                    this.open = false;
                },
                removeTag(index) {
                    this.selected.splice(index, 1);
                }
            }
        }
    </script>
@endsection

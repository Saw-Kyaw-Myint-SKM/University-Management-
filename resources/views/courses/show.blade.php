<x-app-layout>
    <x-slot name="header">
        <div class="flex items-center justify-between">
            <h2 class="font-semibold text-2xl text-gray-800 leading-tight">
                {{ __('Course Details') }}
            </h2>
            <div class="flex items-center space-x-3">
                <a href="{{ route('courses.edit', $course) }}" class="flex items-center px-5 py-2.5 bg-gradient-to-r from-amber-500 to-amber-600 text-white font-semibold rounded-xl hover:from-amber-600 hover:to-amber-700 transition-all duration-300 shadow-lg hover:shadow-xl">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 5H6a2 2 0 00-2 2v11a2 2 0 002 2h11a2 2 0 002-2v-5m-1.414-9.414a2 2 0 112.828 2.828L11.828 15H9v-2.828l8.586-8.586z" />
                    </svg>
                    Edit
                </a>
                <a href="{{ route('courses.index') }}" class="flex items-center px-5 py-2.5 bg-gray-100 text-gray-700 font-semibold rounded-xl hover:bg-gray-200 transition-all duration-300">
                    <svg class="w-5 h-5 mr-2" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 19l-7-7m0 0l7-7m-7 7h18" />
                    </svg>
                    Back
                </a>
            </div>
        </div>
    </x-slot>

    <div class="py-6">
        <div class="max-w-5xl mx-auto sm:px-6 lg:px-8 space-y-6">

            {{-- Header Card --}}
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="bg-gradient-to-r from-emerald-500 to-emerald-600 px-8 py-6">
                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <div class="w-16 h-16 bg-white/20 backdrop-blur-sm rounded-2xl flex items-center justify-center mr-6">
                                <svg class="w-9 h-9 text-white" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 6.253v13m0-13C10.832 5.477 9.246 5 7.5 5S4.168 5.477 3 6.253v13C4.168 18.477 5.754 18 7.5 18s3.332.477 4.5 1.253m0-13C13.168 5.477 14.754 5 16.5 5c1.747 0 3.332.477 4.5 1.253v13C19.832 18.477 18.247 18 16.5 18c-1.746 0-3.332.477-4.5 1.253" />
                                </svg>
                            </div>
                            <div>
                                <p class="text-emerald-100 text-sm font-medium mb-1">{{ $course->code }}</p>
                                <h3 class="text-2xl font-bold text-white">{{ $course->name }}</h3>
                                <p class="text-emerald-100 text-sm mt-1">{{ $course->department->name ?? 'N/A' }} &mdash; {{ $course->department->faculty->name ?? 'N/A' }}</p>
                            </div>
                        </div>
                        <div class="text-right">
                            <p class="text-emerald-100 text-sm">Credit Hours</p>
                            <p class="text-4xl font-bold text-white">{{ $course->credits }}</p>
                        </div>
                    </div>
                </div>

                {{-- Stats row --}}
                <div class="grid grid-cols-3 divide-x divide-gray-100 border-t border-gray-100">
                    <div class="px-8 py-5 text-center">
                        <p class="text-2xl font-bold text-gray-900">{{ $course->enrollments->count() }}</p>
                        <p class="text-sm text-gray-500 mt-0.5">Enrolled Students</p>
                    </div>
                    <div class="px-8 py-5 text-center">
                        <p class="text-2xl font-bold text-gray-900">{{ $course->exams->count() }}</p>
                        <p class="text-sm text-gray-500 mt-0.5">Exams</p>
                    </div>
                    <div class="px-8 py-5 text-center">
                        <p class="text-2xl font-bold text-gray-900">
                            {{ $course->exams->where('status', 'completed')->count() }}
                        </p>
                        <p class="text-sm text-gray-500 mt-0.5">Completed Exams</p>
                    </div>
                </div>
            </div>

            {{-- Info + Description --}}
            <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">

                {{-- Course Info --}}
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <h4 class="text-lg font-semibold text-gray-900 mb-5 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-emerald-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 16h-1v-4h-1m1-4h.01M21 12a9 9 0 11-18 0 9 9 0 0118 0z" />
                        </svg>
                        Course Information
                    </h4>
                    <div class="space-y-4">
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-500 font-medium text-sm">Course Code</span>
                            <span class="font-mono font-bold text-emerald-700 bg-emerald-50 px-3 py-1 rounded-lg text-sm">{{ $course->code }}</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-500 font-medium text-sm">Course Name</span>
                            <span class="text-gray-900 font-semibold text-sm text-right max-w-xs">{{ $course->name }}</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-500 font-medium text-sm">Credits</span>
                            <span class="text-gray-900 font-semibold text-sm">{{ $course->credits }} {{ $course->credits === 1 ? 'credit' : 'credits' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-3 border-b border-gray-100">
                            <span class="text-gray-500 font-medium text-sm">Department</span>
                            <span class="inline-flex items-center px-3 py-1 rounded-full text-xs font-medium bg-blue-100 text-blue-800">{{ $course->department->name ?? 'N/A' }}</span>
                        </div>
                        <div class="flex justify-between items-center py-3">
                            <span class="text-gray-500 font-medium text-sm">Faculty</span>
                            <span class="text-gray-900 font-semibold text-sm">{{ $course->department->faculty->name ?? 'N/A' }}</span>
                        </div>
                    </div>
                </div>

                {{-- Description --}}
                <div class="bg-white rounded-2xl shadow-xl p-6">
                    <h4 class="text-lg font-semibold text-gray-900 mb-5 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-amber-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4 6h16M4 12h16M4 18h7" />
                        </svg>
                        Description
                    </h4>
                    @if($course->description)
                        <p class="text-gray-700 leading-relaxed">{{ $course->description }}</p>
                    @else
                        <p class="text-gray-400 italic">No description provided.</p>
                    @endif

                    {{-- Exams summary --}}
                    @if($course->exams->count() > 0)
                        <div class="mt-6 pt-6 border-t border-gray-100">
                            <p class="text-sm font-semibold text-gray-700 mb-3">Exams</p>
                            <div class="space-y-2">
                                @foreach($course->exams->take(5) as $exam)
                                    <div class="flex items-center justify-between">
                                        <span class="text-sm text-gray-600 truncate max-w-xs">{{ $exam->title }}</span>
                                        <span class="ml-2 flex-shrink-0 inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $exam->status === 'completed' ? 'bg-emerald-100 text-emerald-800' : ($exam->status === 'published' ? 'bg-blue-100 text-blue-800' : 'bg-gray-100 text-gray-600') }}">
                                            {{ ucfirst($exam->status) }}
                                        </span>
                                    </div>
                                @endforeach
                                @if($course->exams->count() > 5)
                                    <p class="text-xs text-gray-400 mt-1">+{{ $course->exams->count() - 5 }} more</p>
                                @endif
                            </div>
                        </div>
                    @endif
                </div>
            </div>

            {{-- Enrolled Students --}}
            @if($course->enrollments->count() > 0)
            <div class="bg-white rounded-2xl shadow-xl overflow-hidden">
                <div class="px-8 py-5 border-b border-gray-100 flex items-center justify-between">
                    <h4 class="text-lg font-semibold text-gray-900 flex items-center">
                        <svg class="w-5 h-5 mr-2 text-blue-600" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M12 4.354a4 4 0 110 5.292M15 21H3v-1a6 6 0 0112 0v1zm0 0h6v-1a6 6 0 00-9-5.197M13 7a4 4 0 11-8 0 4 4 0 018 0z" />
                        </svg>
                        Enrolled Students
                    </h4>
                    <span class="px-3 py-1 rounded-full text-sm font-medium bg-blue-100 text-blue-800">
                        {{ $course->enrollments->count() }} total
                    </span>
                </div>
                <div class="overflow-x-auto">
                    <table class="w-full">
                        <thead class="bg-gray-50">
                            <tr>
                                <th class="px-8 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Student</th>
                                <th class="px-8 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Student No.</th>
                                <th class="px-8 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Semester</th>
                                <th class="px-8 py-4 text-left text-xs font-semibold text-gray-500 uppercase tracking-wider">Status</th>
                            </tr>
                        </thead>
                        <tbody class="divide-y divide-gray-100">
                            @foreach($course->enrollments->take(10) as $enrollment)
                                <tr class="hover:bg-gray-50 transition-colors">
                                    <td class="px-8 py-4">
                                        <div class="flex items-center">
                                            <div class="w-9 h-9 bg-gradient-to-br from-blue-500 to-blue-600 rounded-full flex items-center justify-center text-white font-bold text-sm mr-3 flex-shrink-0">
                                                {{ strtoupper(substr($enrollment->student->user->name ?? '?', 0, 1)) }}
                                            </div>
                                            <div>
                                                <p class="text-sm font-semibold text-gray-900">{{ $enrollment->student->user->name ?? 'N/A' }}</p>
                                                <p class="text-xs text-gray-400">{{ $enrollment->student->user->email ?? '' }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-8 py-4 text-sm font-mono text-gray-600">{{ $enrollment->student->student_number ?? 'N/A' }}</td>
                                    <td class="px-8 py-4 text-sm text-gray-600">{{ $enrollment->semester }} &mdash; {{ $enrollment->academic_year }}</td>
                                    <td class="px-8 py-4">
                                        <span class="inline-flex items-center px-2.5 py-0.5 rounded-full text-xs font-medium
                                            {{ $enrollment->status === 'active' ? 'bg-emerald-100 text-emerald-800' : ($enrollment->status === 'completed' ? 'bg-blue-100 text-blue-800' : 'bg-red-100 text-red-800') }}">
                                            {{ ucfirst($enrollment->status) }}
                                        </span>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                    @if($course->enrollments->count() > 10)
                        <div class="px-8 py-4 bg-gray-50 border-t border-gray-100 text-sm text-gray-500">
                            Showing 10 of {{ $course->enrollments->count() }} enrolled students.
                        </div>
                    @endif
                </div>
            </div>
            @endif

        </div>
    </div>
</x-app-layout>

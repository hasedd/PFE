<x-guest-layout>
    <x-jet-authentication-card>
        <x-slot name="logo">
            <x-jet-authentication-card-logo />
        </x-slot>
        <x-jet-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('register') }}">
            @csrf
            <div x-data ="{ts : true}" >
                <div class="">
                    <x-jet-label for="email" value="{{ __('Email') }}" />
                    <x-jet-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required/>
                </div>

                <div class="mt-4" >
                    <x-jet-label for="type" value="{{ __('Type') }}" />
                    <div style="text-align: center">
                        <x-jet-input @click="ts = true"  id="type1" class="ml-5 mr-1" type="radio" name="type" checked="checked" value="Student" />
                        <x-jet-label for="type1" class="inline">Student</x-jet-label>
                        <x-jet-input @click="ts = true"  id="type2" class="ml-5 mr-1" type="radio" name="type" value="Teacher"/>
                        <x-jet-label class="inline" for="type2" >Teacher </x-jet-label>
                        <x-jet-input  @click="ts = false"  id="type3" class="ml-5 mr-1" type="radio" name="type" value="Other"/>
                        <x-jet-label class="inline" for="type3" >Other </x-jet-label>
                    </div>
                </div>

                <template x-if="ts===false">
                    <div class="mt-4">
                        <x-jet-label for="f_name" value="{{ __('First Name') }}" />
                        <x-jet-input id="f_name" class="block mt-1 w-full" type="text" name="f_name" :value="old('f_name')" required/>
                    </div>
                </template>
                <template x-if="ts===false">
                    <div class="mt-4">
                        <x-jet-label for="l_name" value="{{ __('Last Name') }}" />
                        <x-jet-input id="l_name" class="block mt-1 w-full" type="text" name="l_name" :value="old('l_name')" required/>
                    </div>
                </template>
                <template x-if="ts===false">
                    <div class="mt-4">
                        <x-jet-label for="age" value="{{ __('Age') }}" />
                        <x-jet-input id="age" class="block mt-1 w-full" type="text" name="age" :value="old('age')" required/>
                    </div>
                </template>
                <template x-if="ts===false">
                    <div class="mt-4">
                        <x-jet-label for="address" value="{{ __('Address') }}" />
                        <x-jet-input id="address" class="block mt-1 w-full" type="text" name="address" :value="old('address')" required/>
                    </div>
                </template>
                <template x-if="ts===false">
                    <div class="mt-4">
                        <x-jet-label for="domain" value="{{ __('Domain') }}" />
                        <x-jet-input id="domain" class="block mt-1 w-full" type="text" name="domain" :value="old('domain')" required/>
                    </div>
                </template>
                <template x-if="ts===false" >
                    <div class="mt-4">
                        <x-jet-label for="university" value="{{ __('University') }}" />
                        <x-jet-input id="university" class="block mt-1 w-full" type="text" name="university" :value="old('university')" required/>
                    </div>
                </template>
                <template x-if="ts===false">
                    <div class="mt-4">
                        <x-jet-label for="diplom" value="{{ __('Diplom') }}" />
                        <x-jet-input id="diplom" class="block mt-1 w-full" type="text" name="diplom" :value="old('diplom')" required/>
                    </div>
                </template>
                    <div class="mt-4" >
                        <x-jet-label for="password" value="{{ __('Password') }}" />
                        <x-jet-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="new-password" />
                    </div>
                    <div class="mt-4">
                        <x-jet-label for="password_confirmation" value="{{ __('Confirm Password') }}" />
                        <x-jet-input id="password_confirmation" class="block mt-1 w-full" type="password" name="password_confirmation" required autocomplete="new-password" />
                    </div>
                    @if (Laravel\Jetstream\Jetstream::hasTermsAndPrivacyPolicyFeature())
                        <div class="mt-4">
                            <x-jet-label for="terms">
                                <div class="flex items-center">
                                    <x-jet-checkbox name="terms" id="terms"/>

                                    <div class="ml-2">
                                        {!! __('I agree to the :terms_of_service and :privacy_policy', [
                                                'terms_of_service' => '<a target="_blank" href="'.route('terms.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Terms of Service').'</a>',
                                                'privacy_policy' => '<a target="_blank" href="'.route('policy.show').'" class="underline text-sm text-gray-600 hover:text-gray-900">'.__('Privacy Policy').'</a>',
                                        ]) !!}
                                    </div>
                                </div>
                            </x-jet-label>
                        </div>
                    @endif
                    <div class="flex items-center justify-end mt-4">
                        <a class="underline text-sm text-gray-600 hover:text-gray-900" href="{{ route('login') }}">
                            {{ __('Already registered?') }}
                        </a>
                        <x-jet-button class="ml-4">
                            {{ __('Register') }}
                        </x-jet-button>
                    </div>
            </div>
        </form>
    </x-jet-authentication-card>
</x-guest-layout>

<?php

namespace App\Support;

use Illuminate\Support\Carbon;

class FakeData
{
    private static function startData(): array
    {
        return [
            ['id' => 1, 'title' => 'Konferencijos pavadinimas 1', 'description' => 'Trumpas aprašymas apie konferenciją nr. 1.', 'lecturers' => 'Vardenis Pavardenis', 'date' => '2026-06-10', 'time' => '10:00', 'address' => 'Adresas 12, Vilnius'],
            ['id' => 2, 'title' => 'Konferencijos pavadinimas 2', 'description' => 'Trumpas aprašymas apie konferenciją nr. 2.', 'lecturers' => 'Antras Vardenis', 'date' => '2025-03-01', 'time' => '14:00', 'address' => 'Gatvė 5, Kaunas'],
            ['id' => 3, 'title' => 'Konferencijos pavadinimas 3', 'description' => 'Trumpas aprašymas apie konferenciją nr. 3.', 'lecturers' => 'Trečias Pavardenis', 'date' => '2026-09-20', 'time' => '09:30', 'address' => 'Adresas 8, korpusas B'],
        ];
    }

    private static function startUsers(): array
    {
        return [
            ['id' => 1, 'first_name' => 'Vardenis', 'last_name' => 'Pavardenis', 'email' => 'vardenis@pastas.lt'],
            ['id' => 2, 'first_name' => 'Vardenė', 'last_name' => 'Pavardenė', 'email' => 'vardene@pastas.lt'],
            ['id' => 3, 'first_name' => 'Trečias', 'last_name' => 'Naudotojas', 'email' => 'trecias@pastas.lt'],
        ];
    }

    public static function raw(): array
    {
        if (! session()->has('sd1_conferences')) {
            session(['sd1_conferences' => self::startData()]);
        }

        return session('sd1_conferences');
    }

    public static function saveRaw(array $list): void
    {
        session(['sd1_conferences' => $list]);
    }

    private static function addPast(array $c): array
    {
        $c['is_past'] = Carbon::parse($c['date'])->startOfDay()->lt(now()->startOfDay());

        return $c;
    }

    public static function conferences(): array
    {
        $x = [];
        foreach (self::raw() as $c) {
            $x[] = self::addPast($c);
        }

        return $x;
    }

    public static function conferenceById($id): ?array
    {
        foreach (self::raw() as $c) {
            if ($c['id'] == $id) {
                return self::addPast($c);
            }
        }

        return null;
    }

    public static function conferencesPlannedOnly(): array
    {
        $x = [];
        foreach (self::conferences() as $c) {
            if (! $c['is_past']) {
                $x[] = $c;
            }
        }

        return $x;
    }

    public static function nextId(): int
    {
        $m = 0;
        foreach (self::raw() as $c) {
            if ($c['id'] > $m) {
                $m = $c['id'];
            }
        }

        return $m + 1;
    }

    public static function registrationsForConference($conferenceId): array
    {
        $base = [
            ['conference_id' => 1, 'name' => 'Vardenis Pavardenis', 'email' => 'vardenis@pastas.lt'],
            ['conference_id' => 1, 'name' => 'Vardenė Pavardenė', 'email' => 'vardene@pastas.lt'],
            ['conference_id' => 2, 'name' => 'Kitas Vardas', 'email' => 'kitas@pastas.lt'],
            ['conference_id' => 3, 'name' => 'Registracija Vardas', 'email' => 'registracija@pastas.lt'],
        ];
        $extra = session('sd1_reg', []);
        if (! is_array($extra)) {
            $extra = [];
        }
        $all = array_merge($base, $extra);
        $out = [];
        foreach ($all as $r) {
            if ($r['conference_id'] == $conferenceId) {
                $out[] = $r;
            }
        }

        return $out;
    }

    public static function saveRegistration($conferenceId, $name, $email): void
    {
        $extra = session('sd1_reg', []);
        if (! is_array($extra)) {
            $extra = [];
        }
        $extra[] = ['conference_id' => $conferenceId, 'name' => $name, 'email' => $email];
        session(['sd1_reg' => $extra]);
    }

    public static function users(): array
    {
        if (! session()->has('sd1_users')) {
            session(['sd1_users' => self::startUsers()]);
        }

        return session('sd1_users');
    }

    public static function saveUsers(array $list): void
    {
        session(['sd1_users' => $list]);
    }

    public static function userById($id): ?array
    {
        foreach (self::users() as $u) {
            if ($u['id'] == $id) {
                return $u;
            }
        }

        return null;
    }
}

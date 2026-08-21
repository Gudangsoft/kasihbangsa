<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Menu extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = ['id'];

    public function creator()
    {
        return $this->belongsTo(User::class, 'created_by', 'id');
    }

    public function getParentAttribute()
    {
        if ($this->parent_id == 0) {
            return null;
        }

        return Menu::find($this->parent_id)?->name;
    }

    public function submenus()
    {
        return $this->hasMany(Menu::class, 'parent_id');
    }

    public function getSubmenuItemsAttribute()
    {
        return $this->submenus;
    }

    public static function generateMenuNumber($parentId)
    {
        if ($parentId == 0) {
            // Cari nomor menu utama terakhir
            $latestNumber = self::where('parent_id', 0)->max('number');
            return $latestNumber ? $latestNumber + 1 : 1;
        } else {
            // Cari nomor submenu terakhir berdasarkan parent_id
            $parentNumber = self::where('id', $parentId)->value('number');
            $lastSubmenu = self::where('parent_id', $parentId)->max('number');

            if ($lastSubmenu) {
                $newSubmenuNumber = $lastSubmenu + 0.1;
            } else {
                $newSubmenuNumber = $parentNumber + 0.1;
            }

            return number_format($newSubmenuNumber, 1);
        }
    }

    public static function boot()
    {
        parent::boot();

        static::deleting(function ($menu) {
            // Jika menu utama dihapus, hapus semua submenunya
            if ($menu->parent_id == 0) {
                $menu->submenus()->delete();
            } else {
                // Jika submenu dihapus, perbarui nomor submenu lainnya
                self::updateSubmenuNumbers($menu->parent_id);
            }
        });

        static::restoring(function ($menu) {
            // Jika menu utama dipulihkan, pulihkan semua submenunya
            if ($menu->parent_id == 0) {
                $menu->submenus()->restore();
            }
        });
    }

    public static function updateSubmenuNumbers($parentId)
    {
        $submenus = self::where('parent_id', $parentId)->orderBy('number')->get();
        $index = 1;

        foreach ($submenus as $submenu) {
            $submenu->update(['number' => number_format($parentId + ($index * 0.1), 1)]);
            $index++;
        }
    }

    public function moveUp()
    {
        // Cari menu sebelumnya dalam parent yang sama
        $previous = self::where('parent_id', $this->parent_id)
            ->where('number', '<', $this->number)
            ->orderBy('number', 'desc')
            ->first();

        // Jika ada menu sebelumnya dalam parent yang sama, tukar posisi
        if ($previous) {
            $temp = $this->number;
            $this->number = $previous->number;
            $previous->number = $temp;
            $this->save();
            $previous->save();
        }
    }

    public function moveDown()
    {
        // Cari menu berikutnya dalam parent yang sama
        $next = self::where('parent_id', $this->parent_id)
            ->where('number', '>', $this->number)
            ->orderBy('number', 'asc')
            ->first();

        // Jika ada menu berikutnya dalam parent yang sama, tukar posisi
        if ($next) {
            $temp = $this->number;
            $this->number = $next->number;
            $next->number = $temp;
            $this->save();
            $next->save();
        }
    }

    public function canMoveUp()
    {
        return self::where('parent_id', $this->parent_id)
            ->where('number', '<', $this->number)
            ->exists();
    }

    public function canMoveDown()
    {
        return self::where('parent_id', $this->parent_id)
            ->where('number', '>', $this->number)
            ->exists();
    }
}

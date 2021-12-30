<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCertificatesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('certificates', function (Blueprint $table) {
            $table->id();
            $table->longText('content');
            $table->timestamps();
        });


        \App\Models\Certificate::create([
           'content' => 'تعتبر شركة Ceramic Shield واحدة من أكبر شركات العناية بالسيارات  في الولايات المتحدة الأمريكية ، وقد قمنا بتوزيع أفلام تظليل النوافذ
 على الشركات في الأسواق المستهدفة منذ عام 2005
لتكوّن كتيّب بمثابة دليل أو مرجع شكلي لهذه الأحرف. خمسة قرون
 من الزمن لم تقضي على هذا النص، بل انه حتى صار مستخدماً
وبشكله الأصلي في الطباعة والتنضيد الإلكتروني. انتشر بشكل كبير
في ستينيّات هذا القرن مع إصدار رقائق "ليتراسيت"

 '
        ]);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('certificates');
    }
}

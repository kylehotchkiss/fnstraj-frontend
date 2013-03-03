/**
 *
 * fnstraj | Statistics & Analysis Javascript
 * Copyright 2011-2013 Kyle Hotchkiss
 * Released under the GPL
 *
 */

jQuery(document).ready(function() {

    database.read( "/fnstraj-statistics/", true, function( data, error ) {
         
         var perModelAverages = perModel(data);
         
         jQuery(".amount").html(data.rows.length);
         
         var averagePredictorTime = new Highcharts.Chart({
            chart: {
                renderTo: 'averagePredictorTime',
                backgroundColor: null,
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false
            },
            
            
            credits: { enabled: false },
            exporting: { enabled: false },
            title: { text: 'Average Prediction Time (Per Model)' },
            
            
            series: [{
                type: 'pie',
                name: 'Average Prediction Time',
                data: [
                    ['GFS',   perModelAverages.gfs.avgPredictorTime],
                    ['GFSHD', perModelAverages.gfshd.avgPredictorTime],
                    ['RAP',   perModelAverages.rap.avgPredictorTime]
                ]
            }]
        }); 
        
        
        var averageCachePerformance = new Highcharts.Chart({
            chart: {
                renderTo: 'averageCachePerformance',
                backgroundColor: null,
                plotBackgroundColor: null,
                plotBorderWidth: null,
                plotShadow: false,
                type: "column"
            }, 
        
        
            credits: { enabled: false },
            exporting: { enabled: false },
            title: { text: 'Average Cache Effectiveness (Per Model)' },            
            xAxis: { categories: ['GFS', 'GFSHD', 'RAP'] },
            yAxis: { title: { text: 'Requests' } },
    
    
            series: [{
                name: 'Average Grads Hits',
                data: [perModelAverages.gfs.avgGradsHits, perModelAverages.gfshd.avgGradsHits, perModelAverages.rap.avgGradsHits]
            }, {
                name: 'Average Cache Hits',
                data: [perModelAverages.gfs.avgCacheHits, perModelAverages.gfshd.avgCacheHits, perModelAverages.rap.avgCacheHits]
            }]
            
        });
        
    });
    
});

 
function perModel( statistics ) {
    //////////////////////////////
    // SUMMARIZE DATA PER-MODEL //
    //////////////////////////////
    var modelSummary = {
        gfs: {
            avgFrames: 0,
            avgGradsHits: 0,
            avgCacheHits: 0,
            avgPredictorTime: 0
        }, gfshd: {
            avgFrames: 0,
            avgGradsHits: 0,
            avgCacheHits: 0,
            avgPredictorTime: 0     
        }, rap: {
            avgFrames: 0,
            avgGradsHits: 0,
            avgCacheHits: 0,
            avgPredictorTime: 0
        }
    }
    
    
    for ( row in statistics.rows ) {
        var data = statistics.rows[row].doc;
    
        if ( data.model === "gfs" ) {
        
            var average = modelSummary.gfs.avgFrames;
            
            modelSummary.gfs.avgFrames += data.frames;
            modelSummary.gfs.avgGradsHits += data.gradsHits;
            modelSummary.gfs.avgCacheHits += data.cacheHits;
            modelSummary.gfs.avgPredictorTime += data.predictorTime;    
            
            if ( average ) {
                modelSummary.gfs.avgFrames /= 2;
                modelSummary.gfs.avgGradsHits /= 2;
                modelSummary.gfs.avgCacheHits /= 2;
                modelSummary.gfs.avgPredictorTime /= 2;
            }
    
        } else if ( data.model === "gfshd" ) {
        
            var average = modelSummary.gfshd.avgFrames;
        
            modelSummary.gfshd.avgFrames += data.frames;
            modelSummary.gfshd.avgGradsHits += data.gradsHits;
            modelSummary.gfshd.avgCacheHits += data.cacheHits;
            modelSummary.gfshd.avgPredictorTime += data.predictorTime;  
            
            if ( average ) {
                modelSummary.gfshd.avgFrames /= 2;
                modelSummary.gfshd.avgGradsHits /= 2;
                modelSummary.gfshd.avgCacheHits /= 2;
                modelSummary.gfshd.avgPredictorTime /= 2;
            }
            
        } else if ( data.model === "rap" ) {
        
            var average = modelSummary.rap.avgFrames;
            
            modelSummary.rap.avgFrames += data.frames;
            modelSummary.rap.avgGradsHits += data.gradsHits;
            modelSummary.rap.avgCacheHits += data.cacheHits;
            modelSummary.rap.avgPredictorTime += data.predictorTime;    
            
            if ( average ) {
                modelSummary.rap.avgFrames /= 2;
                modelSummary.rap.avgGradsHits /= 2;
                modelSummary.rap.avgCacheHits /= 2;
                modelSummary.rap.avgPredictorTime /= 2;
            }
            
        }
        
    }
    
    return modelSummary;
}
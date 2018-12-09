package include.trap.api.temperature;

import org.springframework.data.elasticsearch.repository.ElasticsearchRepository;
import org.springframework.stereotype.Repository;

@Repository
public interface TemperatureRepository extends ElasticsearchRepository<Temperature, Long> {

}
